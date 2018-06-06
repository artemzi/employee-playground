@extends('layouts.app')

@section('content')
    <div id="tree"></div>
    <hr>
    <p>Total: {{ count($employees) }}</p>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Position</th>
        </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>
                        @for ($i = 0; $i < $employee->depth; $i++) &mdash; @endfor
                        <a href="#">{{ $employee->full_name }}</a>
                    </td>
                    <td>{{ $employee->title->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
