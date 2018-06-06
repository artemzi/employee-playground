@extends('layouts.app')

@section('content')

    <div class="employee-content">
        <div class="employee_table">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Title</th>
                    <th>Hire Date</th>
                    <th>Salary (RUB)</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->full_name }}</td>
                        <td>{{ $employee->title->name }}</td>
                        <td>{{ Carbon\Carbon::parse($employee->hire_date)->format('d M / Y') }}</td>
                        <td>@salary($employee->salary)</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $employees->links() }}
        </div>
    </div>

@endsection