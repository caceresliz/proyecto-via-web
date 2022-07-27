@include('common.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Monto: </label>
            <input type="text" wire:model.lazy="monto" class="form-control" placeholder="Monto..." maxlength="10">
            @error('monto') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Fecha: </label>
            <input type="date" wire:model.lazy="fecha" class="form-control">
            @error('fecha') <span class="text-danger">{{$message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Razon: </label>
            <input type="text" wire:model.lazy="razon" class="form-control" placeholder="Razon...">
            @error('razon') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-col-md-4">
        <div class="form-group">
            <label>Usuario: </label>
            <select wire:model="userid2" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($users2 as $user2)
                    <option value="{{$user2->id}}"> {{$user2->name.' '.$user2->apellido}}</option>
                @endforeach
            </select>
            @error('userid2') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')
