@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="Nombre">
            @error('nombre')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Descripcion</label>
            <input type="text" wire:model.lazy="descripcion" class="form-control" placeholder="Descripcion">
            @error('descripcion')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Tarifa</label>
            <input type="text" wire:model.lazy="tarifa" class="form-control" placeholder="Tarifa">
            @error('codigo')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Promocion</label>
            <select wire:model='promocion_id' class="form-control">
                <option value="Elegir" disabled>
                    @foreach ($promociones as $promocion)
                        <option value="{{$promocion->id}}">{{$promocion->nombre}}</option>
                    @endforeach
                </option>
            </select>
            @error('promocion_id')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')