@include('common.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Numero: </label>
            <input type="number" wire:model.lazy="numero" class="form-control" placeholder="Numero..." maxlength="10">
            @error('numero') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-col-md-4">
        <div class="form-group">
            <label>Clientes</label>
            <select wire:model="clienteid" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($clientes as $cliente)
                    <option value="{{$cliente->id}}"> {{$cliente->nombre.' '.$cliente->apellidos}}</option>
                @endforeach
            </select>
            @error('clienteid') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')


