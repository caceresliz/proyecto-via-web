@include('common.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Nombre: </label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Nombre...">
            @error('name') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Apellido: </label>
            <input type="text" wire:model.lazy="apellido" class="form-control" placeholder="Apellido...">
            @error('apellido') <span class="text-danger er"> {{$message}} </span> @enderror
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
            <input type="text" wire:model.lazy="email" class="form-control" placeholder="Correo...">
            @error('email') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Contraseña: </label>
            <input type="text" wire:model.lazy="password" class="form-control" placeholder="Contraseña...">
            @error('password') <span class="text-danger er"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="col-sm-12">
    <div class="form-group mr-12">
        <label>Rol: </label>
        <select wire:model.lazy="role" class="form-control">
            <option value="Elegir">Selecciona un Rol</option>
            @foreach($roles as $rol)
                <option value="{{$rol->name}}">{{$rol->name}}</option>
            @endforeach
            @error('role') <span class="text-danger er">{{$message}}</span> @enderror
        </select>
    </div>
    </div>
</div>

@include('common.modalFooter')

