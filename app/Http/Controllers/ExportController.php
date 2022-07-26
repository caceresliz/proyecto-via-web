<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\servicio;


class ExportController extends Controller
{
    public function reportPDF($reportType){
        $data = servicio::join('clientes as c','c.id','servicios.cliente_id')
                            ->select('servicios.*','c.nombre as dato')
                            ->get();

        $pdf = PDF::loadView('pdf.reporte', compact('data','reportType'));

        return $pdf->stream('Report.pdf');
    }
}
