@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{!! route('table') !!}">Back to list</a>
        </div>
        <div class="col-md-12 float-left">
            <div class="card mt-5">
                {{--<div class="card-header text-center"></div>--}}

                <div class="card-body">
                    <h5>{{ $employee->full_name }}</h5>
                    <p>Position: {{ $employee->title->name }}</p>
                    <p>Hire Date: {{ \Carbon\Carbon::parse($employee->hire_date)->format('d M Y') }}</p>
                    <p>Salary (RUB): {{ $employee->salary }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
