<form class="" method="post" action="{{ route('designation.update',[$currentWorkspace->slug,$designation->id]) }}">
    @csrf
     <div class="modal-body">
    <div class="form-group">
        <label for="name" class="col-form-label">{{ __('Name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$designation->name}}" required/>
    </div>
</div>
     <div class=" modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close')}}</button>
            <input type="submit" value="{{ __('Save Changes' )}}" class="btn  btn-primary">
        </div>
</form>
