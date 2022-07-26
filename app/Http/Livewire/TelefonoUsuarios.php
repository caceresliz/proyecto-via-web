<?php

namespace App\Http\Livewire;

use App\Models\cliente;
use App\Models\telefonocliente;
use App\Models\telefonouser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TelefonoUsuarios extends Component
{
    use WithPagination;
    public $numero, $search, $name, $apellido, $selected_id, $usersid, $pageTitle, $componentName;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle ='Listado';
        $this->componentName = 'Telefono del Cliente';
        $this->usersid = 'Elegir';
    }


    public function render()
    {
        if (strlen($this->search))
            $telefono=telefonouser::join('users as u','u.id','telefonousers.user_id')
                ->select('telefonousers.*','u.name as name','u.apellido as apellido')
                ->where('telefonousers.numero','like','%'.$this->search.'%')
                ->orWhere('u.name','like','%'.$this->search.'%')
                ->orderBy('u.name','asc')
                ->paginate($this->pagination);
        else
            $telefono=telefonouser::join('users as u','u.id','telefonousers.user_id')
                ->select('telefonousers.*','u.name as name','u.apellido as apellido')
                ->orderBy('u.name','asc')
                ->paginate($this->pagination);
        $data = User::orderBy('name','asc')->get();
        return view('livewire.telefonouser.telefono-usuarios',[
            'telefonousers'=>$telefono,
            'users'=>$data
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Store()
    {
        $rules = [
            'numero'=>'required|min:7|numeric',
            'usersid'=>'required|not_in:Elegir'
        ];
        $message =[
            'numero.required'=>'Numero del Usuario requerido',
            'numero.min'=>'El numero minimo de caracteres son 7',
            'numero.numeric'=>'El numero ingresado deben de ser numericos',
            'usersid.not_in'=>'Elige un nombre de Usuario diferente de Elegir'
        ];
        $this->validate($rules,$message);
        $telefono = telefonouser::create([
            'numero'=> $this->numero,
            'user_id'=>$this->usersid
        ]);
        $telefono->save();
        $this->resetUI();
        $this->emit('telefono-added','Telefono Registrado');
    }

    public function Edit(telefonouser $telefono){
        $this->selected_id = $telefono->id;
        $this->numero = $telefono->numero;
        $this->usersid= $telefono->user_id;
        $this->emit('show-modal','Show Modal');
    }

    public function Update()
    {
        $rules = [
            'numero'=>'required|min:7|numeric',
            'usersid'=>'required|not_in:Elegir'
        ];
        $message =[
            'numero.required'=>'Numero del Usuario requerido',
            'numero.min'=>'El numero minimo de caracteres son 7',
            'numero.numeric'=>'El numero ingresado deben de ser numericos',
            'usersid.not_in'=>'Elige un nombre de Usuario diferente de Elegir'
        ];
        $this->validate($rules,$message);
        $telefono = telefonouser::find($this->selected_id);
        $telefono->update([
            'numero'=> $this->numero,
            'user_id'=>$this->usersid
        ]);
        $telefono->save();
        $this->resetUI();
        $this->emit('telefono-updated','Telefono Actualizado');
    }

    public function resetUI(){
        $this->numero='';
        $this->usersid='Elegir';
        $this->name='';
        $this->apellido='';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = ['deleteRow'=>'Destroy'];

    public function Destroy(telefonouser $telefono){
        $telefono->delete();
        $this->resetUI();
        $this->emit('telefono-deleted','Telefono Eliminado');
    }
}
