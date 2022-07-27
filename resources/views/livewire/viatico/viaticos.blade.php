<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
                    </li>
                </ul>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Usuario</label>
                            <select wire:model="userid" class="form-control">
                                <option value="Elegir" disabled >Elegir</option>
                                @foreach($users as $usuario)
                                    <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                @endforeach
                            </select>
                            @error('userid') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Fecha Inicial</label>
                            <input type="date" wire:model.lazy="fromDate" class="form-control">
                            @error('fromDate') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Fecha Final</label>
                            <input type="date" wire:model.lazy="toDate" class="form-control">
                            @error('toDate') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 align-self-center d-flex justify-content-around">
                        @if($userid > 0 && $fromDate !=null && $toDate!=null)
                            <button type="button" wire:click.prevent="Consultar" class="btn btn-dark">Consultar</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12 col-md-2 mbmobile">
                    <div class="connect-sorting bg-dark">
                        <h5 class="text-white">Monto Total: Bs {{number_format($total,2)}}</h5>
                    </div>
                </div>
                <div class="col-sm-12 col-md-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-white">Nombre</th>
                                <th class="table-th text-white">Apellido</th>
                                <th class="table-th text-white">Monto</th>
                                <th class="table-th text-white">fecha</th>
                                <th class="table-th text-white">Razon</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($total <= 0)
                                <tr><td colspan="8"><h6 class="text-center">No hay Viatico</h6></td></tr>
                            @endif
                            @foreach ($viaticos as $viatico)
                                <tr>
                                    <td><h6>{{$viatico->name}}</h6></td>
                                    <td><h6>{{$viatico->apellido}}</h6></td>
                                    <td><h6>{{$viatico->monto}}</h6></td>
                                    <td><h6>{{$viatico->fecha}}</h6></td>
                                    <td><h6>{{$viatico->razon}}</h6></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <!-- Contador de visitas -->
                <center><a href="https://websmultimedia.com/contador-de-visitas-gratis" title="Contador De Visitas Gratis">
                <img style="border: 0px solid; display: inline;" alt="contador de visitas" src="https://websmultimedia.com/contador-de-visitas.php?id=3927"></a><br><a href='https://websmultimedia.com/contador-de-visitas-gratis'>Contador</a><br><a href='http://boxindian.com/'></a></center>
            <!-- Fin Contador de visitas -->
        </div>
    </div>
    @include('livewire.viatico.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('viatico-added', msg => {
            $('#theModal').modal('hide');
            noty(msg);
        });

        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide');
        });

        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        });

        $('#theModal').on('hidden.bs.modal', function (e) {
            $('.er').css('display', 'none');
        });
    });

</script>
