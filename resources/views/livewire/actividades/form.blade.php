@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Fecha Inicial</label>
            <input type="date" wire:model.lazy="inicio" class="form-control">
            @error('inicio')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Fecha Fin</label>
            <input type="date" wire:model.lazy="fin" class="form-control">
            @error('fin')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Estado</label>
            <input type="text" wire:model.lazy="estado" class="form-control">
            @error('estado')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Servicio cod.</label>
            <select wire:model='servicio_id' class="form-control">
                <option value="Elegir" disabled>
                    @foreach ($servicios as $servicio)
                        <option value="{{$servicio->id}}">{{$servicio->codigo}}</option>
                    @endforeach
                </option>
            </select>
            @error('servicio_id')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')