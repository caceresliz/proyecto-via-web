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
            <label>Descuento: </label>
            <input type="text" wire:model.lazy="descuento" class="form-control" placeholder="Descuento...">
            @error('descuento') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Inicio: </label>
            <input type="date" wire:model.lazy="inicio" class="form-control">
            @error('inicio') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Fin: </label>
            <input type="date" wire:model.lazy="fin" class="form-control">
            @error('fin') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')
