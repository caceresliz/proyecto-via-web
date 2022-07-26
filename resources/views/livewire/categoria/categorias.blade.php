<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                {{-- <h4>
                    <b>{{$contador}}</b>
                </h4> --}}
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c;">
                            <tr>
                                <th class="table-th text-white">Nombre</th>
                                <th class="table-th text-white">Descripcion</th>
                                <th class="table-th text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                            <tr>
                                <td>
                                    <h6>{{$categoria->nombre}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$categoria->descripcion}}</h6>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-dark mtmobile" title="Edit" wire:click="Edit({{$categoria->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    </a>
                                    
                                    <a href="javascript:void(0)" class="btn btn-dark" title="Delete" onclick="Confirm('{{$categoria->id}}','{{$categoria->products->count()}}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$categorias->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.categoria.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('categoria-added', msg => {
            $('#theModal').modal('hide');
            noty(msg);
        });

        window.livewire.on('categoria-updated', msg => {
            $('#theModal').modal('hide');
            noty(msg);
        });

        window.livewire.on('categoria-deleted', msg => {
            noty(msg);
        });

        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide');
        });

        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        });

        window.livewire.on('hidden.bd.modal', msg => {
            $('.er').css('display', 'none');
        });
    });

    function Confirm(id, products){
        if(products > 0){
            swal('No se puede eliminar la categroia porque tiene productos relacionados!');
            return;
        }
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
                window.livewire.emit('deleteRow', id);
                swal.close();
            }
        });
    }
</script>
