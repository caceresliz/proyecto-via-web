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
            <label>Descripcion: </label>
            <input type="text" wire:model.lazy="descripcion" class="form-control" placeholder="Descripcion...">
            @error('descripcion') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')
