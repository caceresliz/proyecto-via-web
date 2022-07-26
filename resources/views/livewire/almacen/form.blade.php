@include('common.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-preprend">
                <span class="input-group-text">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="direccion" class="form-control" placeholder="Direccion...">
        </div>
        @error('direccion')
            <span class="text-danger er">
                {{$message}}
            </span>
        @enderror
    </div>
</div>

@include('common.modalFooter')
