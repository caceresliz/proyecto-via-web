@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Direccion</label>
            <input type="text" wire:model.lazy="direccion" class="form-control" placeholder="Direccion..">
            @error('direccion')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Codigo</label>
            <input type="text" wire:model.lazy="codigo" class="form-control" placeholder="Codigo del servicio">
            @error('codigo')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Tipo</label>
            <input type="text" wire:model.lazy="tipo" class="form-control" placeholder="Tipo de servicio">
            @error('tipo')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Planes</label>
            <select wire:model='plan_id' class="form-control">
                <option value="Elegir" disabled>
                    @foreach ($planes as $plan)
                        <option value="{{$plan->id}}">{{$plan->nombre}}</option>
                    @endforeach
                </option>
            </select>
            @error('plan_id')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Tecnicos</label>
            <select wire:model='user_id' class="form-control">
                <option value="Elegir" disabled>
                    @foreach ($tecnicos as $tecnico)
                        <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
                    @endforeach
                </option>
            </select>
            @error('user_id')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Clientes</label>
            <select wire:model='cliente_id' class="form-control">
                <option value="Elegir" disabled>
                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                    @endforeach
                </option>
            </select>
            @error('cliente_id')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')