<?php

namespace App\Http\Livewire;
use App\Models\promocion;
use Livewire\WithPagination;

use Livewire\Component;

class Promocions extends Component
{
    use WithPagination;

    public $nombre, $descuento, $inicio, $fin, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Promociones';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = promocion::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else{
            $data = promocion::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.promocion.promocion', ['promociones' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id){
        $record = promocion::find($id, ['id', 'nombre', 'descuento', 'inicio', 'fin']);
        $this->nombre = $record->nombre;
        $this->descuento = $record->descuento;
        $this->inicio = $record->inicio;
        $this->fin = $record->fin;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }

    public function Store(){
        $rules = [
            'nombre' => 'required | min:3',
        ];

        $messages = [
            'nombre.required' => 'Nombre de la promocion es requerido',
            'nombre.min' => 'El nombre de la promocion debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $categoria = promocion::create([
            'nombre' => $this->nombre,
            'descuento' => $this->descuento,
            'inicio' => $this->inicio,
            'fin' => $this->fin
        ]);

        $categoria->save();
        $this->resetUI();
        $this->emit('promocion-added', 'Promocion Registrada!');
    }

    public function Update(){
        $rules = [
            'nombre' => 'required | min:3'
        ];

        $messages = [
            'nombre.required' => 'Nombre de la promocion es requerido'
        ];

        $this->validate($rules, $messages);

        $promocion = promocion::find($this->selected_id);
        $promocion->update([
            'nombre' => $this->nombre,
            'descuento' => $this->descuento,
            'inicio' => $this->inicio,
            'fin' => $this->fin
        ]);

        $promocion->save();
        $this->resetUI();
        $this->emit('promocion-updated', 'Promocion actualizada!');
    }

    public function resetUI(){
        $this->nombre = '';
        $this->descripcion = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id){
        $promocion = promocion::find($id);
        /* dd($categoria); */
        $promocion->delete();
        $this->resetUI();
        $this->emit('promocion-deleted', 'Promocion eliminada!');
    }
}
