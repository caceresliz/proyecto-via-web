<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\plan;
use App\Models\promocion;
use Livewire\WithPagination;

class Plans extends Component
{

    use WithPagination;

    public $nombre, $descripcion, $tarifa, $promocion_id, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Planes';
        $this->promocion_id = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = plan::join('promocions as p','p.id','plans.promocion_id')
                    ->select('plans.*','p.nombre as promocion')
                    ->where('plans.nombre','like','%' . $this->search . '%')
                    ->orWhere('p.nombre','like','%' . $this->search . '%')
                    ->orderBy('plans.nombre','asc')
                    ->paginate($this->pagination);
        }else{
            $data = plan::join('promocions as p','p.id','plans.promocion_id')
                    ->select('plans.*','p.nombre as promocion')
                    ->orderBy('plans.nombre','asc')
                    ->paginate($this->pagination);
        }
        return view('livewire.plan.plan', [
            'planes' => $data,
            'promociones' => promocion::orderBy('nombre', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(){
        $rules = [
            'nombre' => 'required',
            'descripcion' => 'required',
            'tarifa' => 'required | numeric',
            'promocion_id' => 'required | not_in:Elegir'
        ];

        $messages = [
            'nombre.required' => 'Nombre requerido',
            'descripcion.required' => 'Descripcion requerida',
            'tarifa.required' => 'Tarifa requerido',
            'tarifa.numeric' => 'Tarifa debe ser un numero',
            'promocion_id.not_in' => 'Elige un almacen'
        ];

        $this->validate($rules, $messages);

        $plan = plan::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'tarifa' => $this->tarifa,
            'promocion_id' => $this->promocion_id
        ]);

        $plan->save();
        $this->resetUI();
        $this->emit('plan-added', 'Plan registrado!');
    }

    public function Edit($id){
        $record = plan::find($id, ['id', 'nombre', 'descripcion', 'tarifa','promocion_id']);
        $this->nombre = $record->nombre;
        $this->descripcion = $record->descripcion;
        $this->tarifa = $record->tarifa;
        $this->promocion_id = $record->promocion_id;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }

    public function Update(){
        $rules = [
            'nombre' => 'required',
            'descripcion' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Nombre requerido',
            'descripcion.required' => 'Descripcion requerida'
        ];

        $this->validate($rules, $messages);

        $plan = plan::find($this->selected_id);
        $plan->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'tarifa' => $this->tarifa,
            'promocion_id' => $this->promocion_id
        ]);

        $plan->save();
        $this->resetUI();
        $this->emit('plan-updated', 'Plan Actualizado!');
    }

    public function resetUI(){
        $this->nombre = '';
        $this->descripcion = '';
        $this->tarifa = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id){
        $plan = plan::find($id);
        /* dd($categoria); */
        $plan->delete();
        $this->resetUI();
        $this->emit('plan-deleted', 'Plan eliminado');
    }

}
