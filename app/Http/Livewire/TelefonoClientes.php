<?php

namespace App\Http\Livewire;

use App\Models\cliente;
use App\Models\telefonocliente;
use Livewire\Component;
use Livewire\WithPagination;

class TelefonoClientes extends Component
{
    use WithPagination;
    public $numero, $search, $nombre, $apellidos, $selected_id, $clienteid, $pageTitle, $componentName;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle ='Listado';
        $this->componentName = 'Telefono del Cliente';
        $this->clienteid = 'Elegir';
    }


    public function render()
    {
        if (strlen($this->search))
            $telefono=telefonocliente::join('clientes as c','c.id','telefonoclientes.cliente_id')
                    ->select('telefonoclientes.*','c.nombre as nombre','c.apellidos as apellidos')
                    ->where('telefonoclientes.numero','like','%'.$this->search.'%')
                    ->orWhere('c.nombre','like','%'.$this->search.'%')
                    ->orderBy('c.nombre','asc')
                    ->paginate($this->pagination);
        else
            $telefono=telefonocliente::join('clientes as c','c.id','telefonoclientes.cliente_id')
                ->select('telefonoclientes.*','c.nombre as nombre','c.apellidos as apellidos')
                ->orderBy('c.nombre','asc')
                ->paginate($this->pagination);
        $data = cliente::orderBy('nombre','asc')->get();
        return view('livewire.telefonocliente.telefono-clientes',[
                'telefonocliente'=>$telefono,
                'clientes'=>$data
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Store()
    {
        $rules = [
          'numero'=>'required|min:7|numeric',
          'clienteid'=>'required|not_in:Elegir'
        ];
        $message =[
            'numero.required'=>'Numero del cliente requerido',
            'numero.min'=>'El numero minimo de caracteres son 7',
            'numero.numeric'=>'El numero ingresado deben de ser numericos',
            'clienteid.not_in'=>'Elige un nombre de cliente diferente de Elegir'
        ];
        $this->validate($rules,$message);
        $telefono = telefonocliente::create([
            'numero'=> $this->numero,
            'cliente_id'=>$this->clienteid
        ]);
        $telefono->save();
        $this->resetUI();
        $this->emit('telefono-added','Telefono Registrado');
    }

    public function Edit(telefonocliente $telefono){
        $this->selected_id = $telefono->id;
        $this->numero = $telefono->numero;
        $this->clienteid = $telefono->cliente_id;
        $this->emit('show-modal','Show Modal');
    }

    public function Update()
    {
        $rules = [
            'numero'=>'required|min:7|numeric',
            'clienteid'=>'required|not_in:Elegir'
        ];
        $message =[
            'numero.required'=>'Numero del cliente requerido',
            'numero.min'=>'El numero minimo de caracteres son 7',
            'numero.numeric'=>'El numero ingresado deben de ser numericos',
            'clienteid.not_in'=>'Elige un nombre de cliente diferente de Elegir'
        ];
        $this->validate($rules,$message);
        $telefono = telefonocliente::find($this->selected_id);
        $telefono->update([
            'numero'=> $this->numero,
            'cliente_id'=>$this->clienteid
        ]);
        $telefono->save();
        $this->resetUI();
        $this->emit('telefono-updated','Telefono Actualizado');
    }

    public function resetUI(){
        $this->numero='';
        $this->clienteid='Elegir';
        $this->nombre='';
        $this->apellidos='';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = ['deleteRow'=>'Destroy'];

    public function Destroy(telefonocliente $telefono){
        $telefono->delete();
        $this->resetUI();
        $this->emit('telefono-deleted','Telefono Eliminado');
    }
}
