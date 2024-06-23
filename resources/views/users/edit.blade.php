<form class="" method="post" action="{{ route('users.update',[$currentWorkspace->slug,$user->id]) }}">
    @csrf
    @method('post')
    <div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <label for="name" class="col-form-label">{{ __('Name')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}"/>
        </div>
        <div class="col-md-12">
            <label for="designation" class="col-form-label">{{ __('Designation')}}</label>
            <select class="form-control form-control-light select2" name="designation_id" id="designation_id">
                <option value="">{{__('Select Designation')}}</option>
                @foreach($designations as $designation)
                    <option value="{{$designation->id}}" @if($user->designation_id == $designation->id) selected @endif>{{$designation->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="col-md-12">
            <label for="email" class="col-form-label">{{ __('Email')}}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}"/>
        </div>
    </div>
    </div>
        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close')}}</button>
            <input type="submit" value="{{ __('Save Changes' )}}" class="btn  btn-primary">
        </div>

</form>


