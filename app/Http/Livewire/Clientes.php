<?php

namespace App\Http\Livewire;

use App\Models\categoria;
use App\Models\cliente;
use App\Models\Count;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;
    public $nombre, $search, $apellidos, $ci, $correo, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Clientes';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = cliente::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else{
            $data = cliente::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.cliente.clientes', ['clientes' => $data])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    function incrementCount($var){
        $count = $var + 1;
        return $count;
    }

    public function Edit(cliente $record){
        $this->nombre = $record->nombre;
        $this->apellidos = $record->apellidos;
        $this->ci = $record->ci;
        $this->correo = $record->correo;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }

    public function Store(){
        $rules = [
            'nombre' => 'required|min:3',
            'apellidos'=>'required|min:3',
            'correo'=> 'email',
            'ci'=> "required|min:6|numeric"
        ];

        $messages = [
            'nombre.required' => 'Nombre de la categoria es requerido',
            'nombre.min'=> 'El nombre de usuario debe de tener 3 caracteres minimo',
            'correo.email' => 'Ingresa un correo valido',
            'ci.required' => 'El carnet de identidad es requerido',
            'ci.min'=> 'El carnet de identidad debe de tener 6 caracteres minimo',
            'ci.numeric' => 'El carnet de identidad solo tiene que ser nuemrico',
        ];

        $this->validate($rules, $messages);

        $categoria = cliente::create([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'ci'=> $this->ci,
            'correo'=> $this->correo
        ]);

        $categoria->save();
        $this->resetUI();
        $this->emit('cliente-added', 'Cliente Registrado!');
    }

    public function Update(){
        $rules = [
            'nombre' => 'required|min:3',
            'apellidos'=>'required|min:3',
            'correo'=> 'email',
            'ci'=> "required|min:6|numeric"
        ];

        $messages = [
            'nombre.required' => 'Nombre de la categoria es requerido',
            'nombre.min'=> 'El nombre de usuario debe de tener 3 caracteres minimo',
            'correo.email' => 'Ingresa un correo valido',
            'ci.required' => 'El carnet de identidad es requerido',
            'ci.min'=> 'El carnet de identidad debe de tener 6 caracteres minimo',
            'ci.numeric' => 'El carnet de identidad solo tiene que ser nuemrico',
        ];

        $this->validate($rules, $messages);

        $categoria = cliente::find($this->selected_id);
        $categoria->update([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'ci'=> $this->ci,
            'correo'=> $this->correo
        ]);

        $categoria->save();
        $this->resetUI();
        $this->emit('cliente-updated', 'Cliente actualizado!');
    }

    function saveCount($con){
        $c = Count::find(1);
        $c->update([
            'contador' => $con
        ]);
        $c->save();
    }

    public function resetUI(){
        $this->nombre = '';
        $this->apellidos = '';
        $this->ci = '';
        $this->correo = '';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(cliente $cliente){
        $cliente->delete();
        $this->resetUI();
        $this->emit('categoria-deleted', 'Cliente eliminado');
    }
}
