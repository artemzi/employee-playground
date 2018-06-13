@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
            <h3>Titles:</h3>
            <p><a href="{!! route('table') !!}">Back to table</a></p>
            <ul class="list-group">
                @foreach($titles as $title)
                    <li class="list-group-item">
                        <a href="#">{{ $title->name }}</a>
                        <a href="{{ route('titles.edit', $title) }}" class="btn btn-success float-right">Edit</a>
                    </li>
                @endforeach
                <div class="row" style="margin-top: 1rem;">
                    <div class="col float-left">
                        <a href="{{ URL::previous() }}" class="btn btn-danger">Cancel</a>
                        <a href="{{ route('titles.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </ul>
        </div>
    </div>
@endsection