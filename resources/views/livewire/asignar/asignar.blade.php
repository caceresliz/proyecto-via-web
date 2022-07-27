<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}}</b>
                </h4>

            </div>

            <div class="widget-content">
                <div class="form-inline">
                    <div class="form-group mr-5">
                        <select wire:model="role" class="form-control">
                            <option value="Elegir">Selecciona un Rol</option>
                            @foreach($roles as $rol)
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button wire:click.prevent="SyncAll" type="button" class="btn btn-dark mbmobile inblock mr-5">Sincronizar Todos</button>
                    <button onclick="Revocar()" type="button" class="btn btn-dark mbmobile mr-5">Revocar Todos</button>
                </div>


                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mt-1">
                                <thead class="text-white" style="background: #3b3f5c;">
                                <tr>
                                    <th class="table-th text-white">ID</th>
                                    <th class="table-th text-white">Permisos</th>
                                    <th class="table-th text-white">Roles con el Permiso</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td><h6>{{$permiso->id}}</h6></td>
                                        <td>
                                            <div class="n-check">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" wire:change="syncPermiso($('#p'+{{$permiso->id}}).is(':checked'), '{{$permiso->name}}')" id="p{{$permiso->id}}" value="{{$permiso->id}}" class="new-control-input" {{$permiso->checked == 1 ? 'checked':''}}>
                                                    <span class="new-control-indicator"></span>
                                                    <h6>{{$permiso->name}}</h6>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{\App\Models\User::permission($permiso->name)->count()}}</h6>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$permisos->links()}}
                        </div>
                    </div>
                </div>
                <!-- Contador de visitas -->
                    <center><a href="https://websmultimedia.com/contador-de-visitas-gratis" title="Contador De Visitas Gratis">
                    <img style="border: 0px solid; display: inline;" alt="contador de visitas" src="https://websmultimedia.com/contador-de-visitas.php?id=3931"></a><br><a href='https://websmultimedia.com/contador-de-visitas-gratis'>Contador</a><br><a href='http://www.websmultimedia.com'></a></center>
                <!-- Fin Contador de visitas -->
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('sync-error', msg => {
            noty(msg);
        });

        window.livewire.on('permi', msg => {
            noty(msg);
        });

        window.livewire.on('syncall', msg => {
            noty(msg);
        });

        window.livewire.on('removeall', msg => {
            noty(msg);
        });
    });

    function Revocar(){
        swal({
            title: 'CONFIRMAR',
            text: 'SEGURO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '$3b3f5c'
        }).then(function(result){
            if(result.value){
                window.livewire.emit('revokeall');
                swal.close();
            }
        });
    }
</script>
