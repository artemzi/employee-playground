@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col  text-right">
            <form method="POST" action="{{ route('employees.destroy', $employee) }}" class="mr-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" id="delete__action">Delete</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{!! route('table') !!}">Back to list</a>
        </div>
        <div class="col-md-12 float-left">
            <div class="card mt-5">
                {{--<div class="card-header text-center"></div>--}}

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="display-4 text-center">
                                {{ $employee->full_name }}
                            </p>
                            <p>Position: {{ $employee->title->name }}</p>
                            @if($employee->getParentId())
                                <p>Manager: <i>{{ $employee->getParent()->full_name }}</i> ( {{ $employee->getParent()->title->name }} )</p>
                            @endif
                            <p>Hire Date: {{ \Carbon\Carbon::parse($employee->hire_date)->format('d M Y') }}</p>
                            <p>Salary: @salary($employee->salary) (RUB)</p>
                        </div>

                        <div class="col-md-6">
                            @if($employee->image)
                                <img src="{{ asset('uploads/' . $employee->image) }}" class="img-thumbnail" alt="Avatar" style="margin-bottom: 1rem;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
