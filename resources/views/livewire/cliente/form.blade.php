@include('common.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Nombre: </label>
            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="Nombre...">
            @error('nombre') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Apellido: </label>
            <input type="text" wire:model.lazy="apellidos" class="form-control" placeholder="Apellido...">
            @error('apellidos') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>C.I.: </label>
            <input type="text" wire:model.lazy="ci" class="form-control" placeholder="CI...">
            @error('ci') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Correo: </label>
            <input type="text" wire:model.lazy="correo" class="form-control" placeholder="Correo...">
            @error('correo') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')

