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
            <label>Cantidad</label>
            <input type="number" wire:model.lazy="cantidad" class="form-control" placeholder="Cantidad">
            @error('cantidad')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Codigo</label>
            <input type="text" wire:model.lazy="codigo" class="form-control" placeholder="Codigo">
            @error('codigo')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Categoria</label>
            <select wire:model='categoria_id' class="form-control">
                <option value="Elegir" disabled>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </option>
            </select>
            @error('categoria_id')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Almacen</label>
            <select wire:model='almacen_id' class="form-control">
                <option value="Elegir" disabled>
                    @foreach ($almacenes as $almacen)
                        <option value="{{$almacen->id}}">{{$almacen->direccion}}</option>
                    @endforeach
                </option>
            </select>
            @error('almacen_id')
                <span class="text-danger er">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')