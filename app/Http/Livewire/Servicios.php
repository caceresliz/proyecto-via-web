<?php

namespace App\Http\Livewire;

use App\Models\cliente;
use App\Models\plan;
use Livewire\Component;
use App\Models\servicio;
use App\Models\User;
use Livewire\WithPagination;

class Servicios extends Component
{

    use WithPagination;

    public $direccion,$codigo,$tipo,$plan_id,$user_id,$cliente_id,$search,$selected_id,$pageTitle,$componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Servicios';
        $this->plan_id = 'Elegir';
        $this->user_id = 'Elegir';
        $this->cliente_id = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = servicio::join('plans as p','p.id','servicios.plan_id')
                    ->join('users as u','u.id','servicios.user_id')
                    ->join('clientes as c','c.id','servicios.cliente_id')
                    ->select('servicios.*','p.nombre as plan','u.name as tecnico','c.nombre as cliente')
                    ->where('servicios.codigo','like','%' . $this->search . '%')
                    ->orWhere('p.nombre','like','%' . $this->search . '%')
                    ->orWhere('u.nombre','like','%' . $this->search . '%')
                    ->orWhere('c.nombre','like','%' . $this->search . '%')
                    ->paginate($this->pagination);
        }else{
            $data = servicio::join('plans as p','p.id','servicios.plan_id')
                    ->join('users as u','u.id','servicios.user_id')
                    ->join('clientes as c','c.id','servicios.cliente_id')
                    ->select('servicios.*','p.nombre as plan','u.name as tecnico','c.nombre as cliente')
                    ->paginate($this->pagination);
        }
        return view('livewire.servicio.servicios', [
            'servicios' => $data,
            'planes' => plan::orderBy('nombre','asc')->get(),
            'tecnicos' => User::select('*')->where('rol','=','TECNICO')->orderBy('name','asc')->get(),
            'clientes' => cliente::orderBy('nombre','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(){
        $rules = [
            'direccion' => 'required',
            'codigo' => 'required',
            'tipo' => 'required',
            'plan_id' => 'required | not_in:Elegir',
            'user_id' => 'required | not_in:Elegir',
            'cliente_id' => 'required | not_in:Elegir',
        ];

        $messages = [
            'direccion.required' => 'Direccion requerido',
            'codigo.required' => 'Codigo requerido',
            'tipo.required' => 'Tipo requerido',
            'plan_id.not_in' => 'Elige un plan',
            'user_id.not_in' => 'Elige un usuario',
            'cliente_id.not_in' => 'Elige un cliente',
        ];

        $this->validate($rules, $messages);

        $servicio = servicio::create([
            'direccion' => $this->direccion,
            'codigo' => $this->codigo,
            'tipo' => $this->tipo,
            'estado' => "Aprobado",
            'plan_id' => $this->plan_id,
            'user_id' => $this->user_id,
            'cliente_id' => $this->cliente_id
        ]);

        $servicio->save();
        $this->resetUI();
        $this->emit('servicio-added', 'Servicio registrado!');
    }

    public function Edit($id){
        $record = servicio::find($id, ['id', 'direccion', 'codigo', 'tipo','plan_id','user_id','cliente_id']);
        $this->direccion = $record->direccion;
        $this->codigo = $record->codigo;
        $this->tipo = $record->tipo;
        $this->plan_id = $record->plan_id;
        $this->user_id = $record->user_id;
        $this->cliente_id = $record->cliente_id;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }

    public function Update(){
        $rules = [
            'direccion' => 'required',
            'codigo' => 'required'
        ];

        $messages = [
            'direccion.required' => 'Direccion requerida',
            'codigo.required' => 'Codigo requerido'
        ];

        $this->validate($rules, $messages);

        $servicio = servicio::find($this->selected_id);
        $servicio->update([
            'direccion' => $this->direccion,
            'codigo' => $this->codigo,
            'tipo' => $this->tipo,
            'estado' => "Actualizado",
            'plan_id' => $this->plan_id,
            'user_id' => $this->user_id,
            'cliente_id' => $this->cliente_id,
        ]);

        $servicio->save();
        $this->resetUI();
        $this->emit('servicio-updated', 'Servicio Actualizado!');
    }

    public function resetUI(){
        $this->direccion = '';
        $this->codigo = '';
        $this->tipo = '';
        $this->estado = ''; 
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id){
        $servicio = servicio::find($id);
        /* dd($categoria); */
        $servicio->delete();
        $this->resetUI();
        $this->emit('servicio-deleted', 'Servicio eliminado');
    }
}
