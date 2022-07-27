<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permisos extends Component
{
    use WithPagination;
    public $name, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 10;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function render()
    {
        if (strlen($this->search >0)){
            $permisos = Permission::where('name','like','%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $permisos = Permission::orderBy('id','asc')->paginate($this->pagination);
        }
        return view('livewire.permisos.permisos',[
            'permisos'=>$permisos
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Store(){
        $rules = [
            'name' => 'required|min:2|unique:permissions,name',
        ];

        $messages = [
            'name.required' => 'Nombre del Permiso es requerido',
            'name.min'=> 'El Permiso de usuario debe de tener 3 caracteres minimo',
            'name.unique' => 'El Permiso ya existe'
        ];
        $this->validate($rules,$messages);
        Permission::create(['name'=>$this->name]);
        $this->emit('permiso-added','Permiso registrado!');
        $this->resetUI();
    }

    public function Edit(Permission $record){
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
        $permiso = Permission::find($this->selected_id);
        $permiso->name = $this->name;
        $permiso->save();
        $this->resetUI();
        $this->emit('permiso-updated', 'Permiso actualizado!');
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

    public function Destroy(Permission $rol){
        $rolesCount = $rol->getRoleNames()->count();
        if($rolesCount>0){
            $this->emit('permiso-error','No se puede eliminar el permiso porque tiene permisos asociados');
            return;
        }
        $rol->delete();
        $this->resetUI();
        $this->emit('permiso-deleted', 'Permiso eliminado');
    }

}
