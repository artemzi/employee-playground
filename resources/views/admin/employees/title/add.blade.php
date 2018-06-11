@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6 float-left">
            <div class="card mt-5">
                <div class="card-header"><h3>Create:</h3></div>

                <div class="card-body">
            <form method="POST" action="{{ route('titles.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>

                <div class="form-group text-right">
                     <a href="{{ URL::previous() }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
                </div>
            </div>
        </div>
        <div class="col-6">

        </div>
    </div>
@endsection