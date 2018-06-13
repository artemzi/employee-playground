<div class="card mt-5">
    {{--<div class="card-header"><h3>Image:</h3></div>--}}

    <div class="card-body">
    @if($employee->image)
        <img src="{{ asset('uploads/' . $employee->image) }}" class="img-thumbnail" alt="Avatar" style="margin-bottom: 1rem;">
    @endif

    <form method="POST" action="{{ route('image', $employee) }}" enctype="multipart/form-data">
        @csrf

        <div class="custom-file" id="customFile" lang="es">
            <input type="file" class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : '' }}" id="image"
                name="image">
            <label class="custom-file-label" for="image">
               <span class="form-control-file">{{ old('image', $employee->image) ? ' change... ' : '' }}</span>
            </label>
            @if ($errors->has('image'))
                <span class="invalid-feedback"><strong>{{ $errors->first('image') }}</strong></span>
            @endif
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
    </form>
    @if (Session::has('message'))
       <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    </div>
</div>