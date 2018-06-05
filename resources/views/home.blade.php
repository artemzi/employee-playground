@extends('layouts.app')

@section('content')
    <p>Total: {{ count($employees) }}</p>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>
                        @for ($i = 0; $i < $employee->depth; $i++) &mdash; @endfor
                        <a href="#">{{ $employee->full_name }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
