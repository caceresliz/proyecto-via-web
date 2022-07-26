<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\actividad;
use App\Models\cliente;
use App\Models\servicio;
use Carbon\Carbon;

class Reportes extends Component
{

    public $componentName,$datas,$reportType;

    public function mount(){
        $this->componentName = 'Reportes';
        $this->reportType = 0;
    } 

    public function render()
    {
        $this->reportByType();
        return view('livewire.reportes.reportes')
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function reportByType(){
        if($this->reportType == 0){  //Reporte de actividades
            $this->datas = servicio::join('clientes as c','c.id','servicios.cliente_id')
                            ->select('servicios.*','c.nombre as dato')
                            ->get();
        }else if($this->reportType == 1){
            $this->datas = servicio::join('plans as p','p.id','servicios.plan_id')
                            ->select('servicios.*','p.nombre as dato')
                            ->get();
        }else{
            $this->datas = servicio::join('users as u','u.id','servicios.user_id')
                            ->select('servicios.*','u.nombre as dato')
                            ->get();
        }
    }
}
