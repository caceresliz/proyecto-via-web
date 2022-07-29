<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\actividad;
use App\Models\servicio;
use Carbon\Carbon;
use Livewire\WithPagination;

class Actividades extends Component
{

    use WithPagination;

    public $inicio, $fin, $foto, $estado, $servicio_id, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Actividades';
        $this->servicio_id = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = actividad::join('servicios as s','s.id','actividads.servicio_id')
                    ->select('actividads.*','s.codigo as codigo')
                    ->where('s.codigo','like','%' . $this->search . '%')
                    ->paginate($this->pagination);
        }else{
            $data = actividad::join('servicios as s','s.id','actividads.servicio_id')
                    ->select('actividads.*','s.codigo as codigo')
                    ->paginate($this->pagination);
        }
        return view('livewire.actividades.actividades', [
            'actividades' => $data,
            'servicios' => servicio::orderBy('codigo', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(){
        $rules = [
            'inicio' => 'required',
            'fin' => 'required',
            'estado' => 'required',
            'servicio_id' => 'required | not_in:Elegir'
        ];

        $messages = [
            'inicio.required' => 'Fecha de inicio es requerido',
            'fin.required' => 'Fecha de fin es requerido',
            'estado.required' => 'el estado es requerido',
            'servicio_id.not_in' => 'Elige un servicio',
        ];

        $this->validate($rules, $messages);

        $fi = Carbon::parse($this->inicio)->format('Y-m-d');
        $ff = Carbon::parse($this->fin)->format('Y-m-d');

        $actividad = actividad::create([
            'inicio' => $fi,
            'fin' => $ff,
            'foto' => 'No sube foto',
            'estado' => $this->estado,
            'servicio_id' => $this->servicio_id
        ]);

        $actividad->save();
        $this->resetUI();
        $this->emit('actividad-added', 'Actividad registrada!');
    }

    public function Edit($id){
        $record = actividad::find($id, ['id', 'inicio', 'fin', 'estado','servicio_id']);
        $this->inicio = $record->inicio;
        $this->fin = $record->fin;
        $this->estado = $record->estado;
        $this->servicio_id = $record->servicio_id;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }

    public function Update(){
        $rules = [
            'inicio' => 'required',
            'fin' => 'required'
        ];

        $messages = [
            'inicio.required' => 'Fecha requerida',
            'fin.required' => 'Fecha requerida'
        ];

        $this->validate($rules, $messages);

        $actividad = actividad::find($this->selected_id);
        $actividad->update([
            'inicio' => $this->inicio,
            'fin' => $this->fin,
            'estado' => $this->estado,
            'servicio_id' => $this->servicio_id
        ]);

        $actividad->save();
        $this->resetUI();
        $this->emit('actividad-updated', 'Actividad Actualizado!');
    }

    public function resetUI(){
        $this->inicio = '';
        $this->fin = '';
        $this->estado = '';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id){
        $actividad = actividad::find($id);
        /* dd($categoria); */
        $actividad->delete();
        $this->resetUI();
        $this->emit('actividad-deleted', 'Actividad eliminado');
    }
}
