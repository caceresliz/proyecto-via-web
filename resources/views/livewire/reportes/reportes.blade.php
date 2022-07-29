<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h4 class="card-title text-center">
                    <b>{{$componentName}}</b>
                </h4>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Elige el reporte</h6>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="0">Servicios - Clientes</option>
                                        <option value="1">Servicio - Plan</option>
                                        <option value="2">Servicios - Tecnicos</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button wire:click="$refresh" class="btn btn-dark btn-block">
                                    Consultar
                                </button>
                        
                                <a href="{{url('reportes/pdf' . '/' . $reportType)}}"
                                    class="btn btn-dark btn-block"
                                    target="_blank"
                                    >Generar PDF</a>
                        
                                <a href="{{url('reportes/excel' . '/' . $reportType)}}"
                                    class="btn btn-dark btn-block"
                                    target="_blank"
                                    >Exportar a excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12-col-md-9">
                        {{-- tabla --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mt-1">
                                <thead class="text-white" style="background: #3b3f5c;">
                                    <tr>
                                        <th class="table-th text-white text-center">Direccion</th>
                                        <th class="table-th text-white text-center">Codigo</th>
                                        <th class="table-th text-white text-center">Tipo</th>
                                        <th class="table-th text-white text-center">Estado</th>
                                        <th class="table-th text-white text-center">Dato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>
                                            <h6>{{$data->direccion}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$data->codigo}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$data->tipo}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$data->estado}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$data->dato}}</h6>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <!-- Contador de visitas -->
            <center><a href="https://websmultimedia.com/contador-de-visitas-gratis" title="Contador De Visitas Gratis">
            <img style="border: 0px solid; display: inline;" alt="contador de visitas" src="https://websmultimedia.com/contador-de-visitas.php?id=4115"></a><br><a href='https://websmultimedia.com/contador-de-visitas-gratis'>Contador</a><br><a href='http://www.websmultimedia.com/diseno-web/sevilla'></a></center>
        <!-- Fin Contador de visitas -->
            
        </div>
        
    </div>
</div>


