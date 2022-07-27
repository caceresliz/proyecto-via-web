<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use DB;


class Roles extends Component
{
    use WithPagination;
    public $name, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function render()
    {
        if (strlen($this->search >0)){
            $roles = Role::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $roles = Role::orderBy('id','asc')->paginate($this->pagination);
        }

        return view('livewire.rol.roles',[
            'roles'=>$roles
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Store(){
        $rules = [
            'name' => 'required|min:2|unique:roles,name',
        ];

        $messages = [
            'name.required' => 'Nombre del Rol es requerido',
            'name.min'=> 'El rol de usuario debe de tener 3 caracteres minimo',
            'name.unique' => 'El rol ya existe'
        ];
        $this->validate($rules,$messages);
        Role::create(['name'=>$this->name]);
        $this->emit('rol-added','Rol Registrado!');
        $this->resetUI();
    }

    public function Edit(Role $record){
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->emit('show-modal', 'show  modal!');
    }

    public function Update()
    {
        $rules = [
            'name' => "required|min:2|unique:roles,name,{$this->selected_id}",
        ];

        $messages = [
            'name.required' => 'Nombre del Rol es requerido',
            'name.min' => 'El rol de usuario debe de tener 3 caracteres minimo',
            'name.unique' => 'El rol ya existe'
        ];
        $this->validate($rules, $messages);
        $rol = Role::find($this->selected_id);
        $rol->name = $this->name;
        $rol->save();
        $this->resetUI();
        $this->emit('rol-updated', 'Rol actualizado!');
    }
    public function resetUI(){
        $this->name = '';
        $this->selected_id = 0;
        $this->search='';
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Role $rol){
        $permissionsCount = $rol->permissions->count();
        if($permissionsCount>0){
            $this->emit('rol-error','No se puede eliminar el role porque tiene permisos asociados');
            return;
        }
        $rol->delete();
        $this->resetUI();
        $this->emit('rol-deleted', 'Rol eliminado!');
    }

}
