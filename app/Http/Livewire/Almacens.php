<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\almacen;
use Livewire\WithPagination;

class Almacens extends Component
{

    use WithPagination;

    public $direccion, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Almacen';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = almacen::where('direccion', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else{
            $data = almacen::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.almacen.almacen', ['almacenes' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id){
        $record = almacen::find($id, ['id','direccion']);
        $this->direccion = $record->direccion;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show modal!');
    }

    public function Store(){
        $rules = [
            'direccion' => 'required | min:3'
        ];

        $messages = [
            'direccion.required' => 'Direccion es requerido',
            'direccion.min' => 'minimo 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $almacen = almacen::create([
            'direccion' => $this->direccion
        ]);

        $almacen->save();
        $this->resetUI();
        $this->emit('almacen-added', 'Almacen registrado!');
    }

    public function Update(){
        $rules = [
            'direccion' => 'required | min:3'
        ];

        $messages = [
            'direccion.required' => 'Direccion requerida',
            'direccion.min:3' => 'minimo 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $almacen = almacen::find($this->selected_id);
        $almacen->update([
            'direccion' => $this->direccion
        ]);

        $almacen->save();
        $this->resetUI();
        $this->emit('almacen-updated', 'Almacen actualizado!');
    }

    public function resetUI(){
        $this->direccion = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id){
        $categoria = almacen::find($id);
        /* dd($categoria); */
        $categoria->delete();
        $this->resetUI();
        $this->emit('almacen-deleted', 'Almacen eliminado!');
    }
}
