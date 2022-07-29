<?php

namespace App\Http\Livewire;

use App\Models\almacen;
use App\Models\categoria;
use Livewire\Component;
use App\Models\producto;
use Livewire\WithPagination;

class Product extends Component
{

    use WithPagination;

    public $nombre, $cantidad, $codigo, $almacen_id, $categoria_id, $actividad_id, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->categoria_id = 'Elegir';
        /*$this->almacen_id = 'Elegir';*/
        $this->actividad_id = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = producto::join('categorias as c','c.id','productos.categoria_id')
                    ->join('almacens as a','a.id','productos.almacen_id')
                    ->select('productos.*','c.nombre as categoria','a.direccion as direccion')
                    ->where('productos.nombre','like','%' . $this->search . '%')
                    ->orWhere('c.nombre','like','%' . $this->search . '%')
                    ->orWhere('a.direccion','like','%' . $this->search . '%')
                    ->orderBy('productos.nombre','asc')
                    ->paginate($this->pagination);
        }else{
            $data = producto::join('categorias as c','c.id','productos.categoria_id')
                    ->join('almacens as a','a.id','productos.almacen_id')
                    ->select('productos.*','c.nombre as categoria','a.direccion as direccion')
                    ->orderBy('productos.nombre','asc')
                    ->paginate($this->pagination);
        }
        return view('livewire.producto.product', [
            'productos' => $data,
            'categorias' => categoria::orderBy('nombre', 'asc')->get(),
            'almacenes' => almacen::select('*')->orderBy('direccion','asc')->get()
            
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(){
        $rules = [
            'nombre' => 'required',
            'cantidad' => 'required',
            'codigo' => 'required | numeric',
            'categoria_id' => 'required | not_in:Elegir',
            'almacen_id' => 'required | not_in:Elegir'
        ];

        $messages = [
            'nombre.required' => 'Nombre requerido',
            'cantidad.required' => 'Cantidad requerido',
            'codigo.required' => 'Codigo requerido',
            'codigo.numeric' => 'Codigo debe ser un numero',
            'categoria_id.not_in' => 'Elige una categoria',
            'almacen_id.not_in' => 'Elige un almacen',
        ];

        $this->validate($rules, $messages);

        $producto = producto::create([
            'nombre' => $this->nombre,
            'cantidad' => $this->cantidad,
            'codigo' => $this->codigo,
            'almacen_id' => $this->almacen_id,
            'categoria_id' => $this->categoria_id
        ]);

        $producto->save();
        $this->resetUI();
        $this->emit('producto-added', 'Producto registrado!');
    }

    public function Edit($id){
        $record = producto::find($id, ['id', 'nombre', 'cantidad', 'codigo','almacen_id','categoria_id']);
        $this->nombre = $record->nombre;
        $this->cantidad = $record->cantidad;
        $this->codigo = $record->codigo;
        $this->almacen_id = $record->almacen_id;
        $this->categoria_id = $record->categoria_id;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }

    public function Update(){
        $rules = [
            'nombre' => 'required',
            'cantidad' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Nombre requerido',
            'cantidad.required' => 'Cantidad requerido'
        ];

        $this->validate($rules, $messages);

        $producto = producto::find($this->selected_id);
        $producto->update([
            'nombre' => $this->nombre,
            'cantidad' => $this->cantidad,
            'codigo' => $this->codigo,
            'almacen_id' => $this->almacen_id,
            'categoria_id' => $this->categoria_id
        ]);

        $producto->save();
        $this->resetUI();
        $this->emit('producto-updated', 'Producto Actualizado!');
    }

    public function resetUI(){
        $this->nombre = '';
        $this->cantidad = '';
        $this->codigo = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id){
        $producto = producto::find($id);
        /* dd($categoria); */
        $producto->delete();
        $this->resetUI();
        $this->emit('producto-deleted', 'Producto eliminado');
    }
}
