<?php

namespace App\Http\Livewire;

use App\Models\viatico;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    use WithPagination;
    public $name, $search, $apellido, $ci, $email, $password, $role, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;


    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuario';
        $this->role='Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function render()
    {
        if(strlen($this->search) > 0){
            $data = User::where('name', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'asc')
                ->paginate($this->pagination);
        }else{
            $data = User::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.usuario.users',[
            'users'=>$data,
            'roles'=> Role::orderBy('id','asc')->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit(User $record){
        $this->name = $record->name;
        $this->apellido = $record->apellido;
        $this->ci = $record->ci;
        $this->email = $record->email;
        $this->role=$record->rol;
        $this->password='';
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }


    public function Store(){
        $rules = [
            'name' => 'required|min:3',
            'apellido'=>'required|min:3',
            'email'=> 'required|email',
            'ci'=> "required|min:6|numeric",
            'role'=> 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'Nombre del Usuario es requerido',
            'name.min'=> 'El nombre de usuario debe de tener 3 caracteres minimo',
            'email.email' => 'Ingresa un correo valido',
            'email.required' => 'Email es requerido',
            'ci.required' => 'El carnet de identidad es requerido',
            'ci.min'=> 'El carnet de identidad debe de tener 6 caracteres minimo',
            'ci.numeric' => 'El carnet de identidad solo tiene que ser nuemrico',
            'role.required'=>'El rol es requerido',
            'role.not_in'=>'Elegia otro rol aparte de Elegir'
        ];

        $this->validate($rules, $messages);

        $usuario = User::create([
            'name' => $this->name,
            'apellido' => $this->apellido,
            'ci'=> $this->ci,
            'email'=> $this->email,
            'rol'=>$this->role,
            'password'=>bcrypt($this->password)
        ]);

        $usuario->syncRoles($this->role);

        $usuario->save();
        $this->resetUI();
        $this->emit('user-added', 'Usuario Registrado!');
    }

    public function Update(){
        $rules = [
            'name' => 'required|min:3',
            'apellido'=>'required|min:3',
            'email'=> 'required|email',
            'ci'=> "required|min:6|numeric",
            'role'=> 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'Nombre del Usuario es requerido',
            'name.min'=> 'El nombre de usuario debe de tener 3 caracteres minimo',
            'email.email' => 'Ingresa un correo valido',
            'email.required' => 'Email es requerido',
            'ci.required' => 'El carnet de identidad es requerido',
            'ci.min'=> 'El carnet de identidad debe de tener 6 caracteres minimo',
            'ci.numeric' => 'El carnet de identidad solo tiene que ser nuemrico',
            'role.required'=>'El rol es requerido',
            'role.not_in'=>'Elegia otro rol aparte de Elegir'
        ];

        $this->validate($rules, $messages);

        $usuario = User::find($this->selected_id);
        $usuario->update([
            'name' => $this->name,
            'apellido' => $this->apellido,
            'ci'=> $this->ci,
            'email'=> $this->email,
            'rol'=>$this->role
        ]);
        $usuario->syncRoles($this->role);
        $usuario->save();
        $this->resetUI();
        $this->emit('user-updated', 'Usuario actualizado!');
    }

    public function resetUI(){
        $this->nombre = '';
        $this->apellido = '';
        $this->ci = '';
        $this->email = '';
        $this->password='';
        $this->search='';
        $this->selected_id = 0;
        $this->role='Elegir';
        $this->resetValidation();
        $this->resetPage();
        $this->password='';
    }

    protected $listeners = [
        'deleteRow' => 'Destroy',
        'resetUI' => 'resetUI'
    ];

    public function Destroy(User $user){
        if ($user) {

            $viatico = viatico::where('user_id', $user->id)->count();
            if ($viatico > 0){
                $this->emit('user-whithsales', 'No es posible eliminar el usuario tiene cuentas de viatico');
        }else {
                $user->delete();
                $this->resetUI();
                $this->emit('user-deleted', 'Usuario eliminado!');
            }
        }
    }

}
