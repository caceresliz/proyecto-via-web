<?php

namespace App\Http\Livewire;

use App\Models\cliente;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\User;
use App\Models\viatico;

class Viaticos extends Component
{
    use WithPagination;
    public $name, $apellido, $monto, $fecha, $razon, $userid, $userid2, $fromDate, $toDate, $total, $viaticos, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Viatico';
        $this->fromDate=null;
        $this->toDate=null;
        $this->fecha=null;
        $this->viaticos=[];
        $this->userid='Elegir';
        $this->userid2='Elegir';
        $this->total=0;
        $this->selected_id=0;
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        return view('livewire.viatico.viaticos', [
            'users' => User::orderBy('name','asc')->get(),
            'users2'=>User::orderBy('name','asc')->get()])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Consultar(){
        $fi = Carbon::parse($this->fromDate)->format('y-m-d');
        $ff = Carbon::parse($this->toDate)->format('y-m-d');
        $idu = $this->userid;

        $this->viaticos = viatico::join('users as u','u.id','=','viaticos.user_id')
            ->select('viaticos.*','u.name as name','u.apellido as apellido')
            ->where("u.id", "=", $idu)
            ->get();
        $this->viaticos->whereBetween('viaticos.created_at',[$fi,$ff])
            ->where('viaticos.user_id','users.id'.$this->userid);
        $this->total = $this->viaticos ? $this->viaticos->sum('monto'):0;
    }

    public function Store(){
        $rules = [
            'monto' => 'required|numeric',
            'fecha'=>'required|date',
            'razon'=> 'required',
            'userid2'=> 'required|not_in:Elegir'
        ];

        $messages = [
            'monto.required' => 'Monto de los Viaticos es requerido',
            'monto.numeric' => 'El monto solo tiene que ser nuemrico',
            'fecha.required' => 'La fecha es requerido',
            'fecha.date'=> 'Fecha no es un formato valido',
            'razon.required' => 'La razon es requerida',
            'userid2.not_in'=>'Elige un nombre de Usuario diferente de Elegir'
        ];

        $this->validate($rules, $messages);

        $viatico = viatico::create([
            'monto' => $this->monto,
            'fecha' => $this->fecha,
            'razon'=> $this->razon,
            'user_id'=> $this->userid2
        ]);
        //dd($viatico);
        $viatico->save();
        $this->resetUI();
        $this->emit('viatico-added', 'Viatico Registrado!');
    }

    public function resetUI(){
        $this->name = '';
        $this->apellido = '';
        $this->fromDate=null;
        $this->toDate=null;
        $this->viaticos=[];
        $this->userid='Elegir';
        $this->userid2='Elegir';
        $this->total=0;
        $this->monto=0;
        $this->razon='';
        $this->fecha=null;
        $this->resetValidation();
        $this->resetPage();
    }
}
