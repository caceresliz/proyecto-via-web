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
            <select wire:model="usersid" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}"> {{$user->name.' '.$user->apellido}}</option>
                @endforeach
            </select>
            @error('usersid') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')
