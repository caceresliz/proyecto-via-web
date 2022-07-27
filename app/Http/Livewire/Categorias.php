<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\categoria;
use Livewire\WithPagination;

class Categorias extends Component
{

    use WithPagination;

    public $nombre, $search, $descripcion, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorias';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = categoria::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else{
            $data = categoria::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.categoria.categorias', ['categorias' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id){
        $record = categoria::find($id, ['id', 'nombre', 'descripcion']);
        $this->nombre = $record->nombre;
        $this->descripcion = $record->descripcion;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }

    public function Store(){
        $rules = [
            'nombre' => 'required | min:3',
        ];

        $messages = [
            'nombre.required' => 'Nombre de la categoria es requerido',
            'nombre.min' => 'El nombre de la categoria debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $categoria = categoria::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);

        $categoria->save();
        $this->resetUI();
        $this->emit('categoria-added', 'Categoria Registrada!');
    }

    public function Update(){
        $rules = [
            'nombre' => 'required | min:3',
            'descripcion' => 'required | min:3'
        ];

        $messages = [
            'nombre.required' => 'Nombre de la categoria es requerido',
            'nombre.min:3' => 'El nombre de la categoria debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $categoria = categoria::find($this->selected_id);
        $categoria->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);

        $categoria->save();
        $this->resetUI();
        $this->emit('categoria-updated', 'Categoria actualizada!');
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
        $categoria = categoria::find($id);
        /* dd($categoria); */
        $categoria->delete();
        $this->resetUI();
        $this->emit('categoria-deleted', 'Categoria eliminada!');
    }
}
