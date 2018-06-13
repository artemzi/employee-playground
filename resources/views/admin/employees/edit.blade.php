@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 float-left">
            <div class="card mt-5">
                <div class="card-header"><h3>Edit:</h3></div>

                <div class="card-body">
            <form method="POST" action="{{ route('employees.update', $employee) }}">
                @csrf
                @method('PUT')

                 <div class="row">
                     <div class="col-8">
                         <div class="form-group">
                            <label for="full_name" class="col-form-label">Full Name</label>
                            <input id="full_name" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name', $employee->full_name) }}" required>
                            @if ($errors->has('full_name'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('full_name') }}</strong></span>
                            @endif
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="title__select">
                            <label for="title" class="col-form-label">Title</label>
                            <select id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title">
                                <option value=""></option>
                                @foreach ($titles as $title)
                                    <option value="{{ $title->id }}"{{ $title->id == old('title', $employee->title->id) ? ' selected' : '' }}>
                                        {{ $title->name }}
                                    </option>
                                @endforeach;
                            </select>
                        <a href="{{ route('titles.index') }}" id="title__add_new">Add new title</a>
                        </div>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                        @endif
                     </div>
                 </div>

                <div class="form-group">
                    <label for="salary" class="col-form-label">Salary</label>
                    <input id="salary" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" name="salary" value="{{ old('salary', $employee->salary) }}" required>
                    @if ($errors->has('salary'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('salary') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="hire_date" class="col-form-label">Hire Date</label>
                    <input id="hire_date" class="form-control{{ $errors->has('hire_date') ? ' is-invalid' : '' }}" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" required>
                    @if ($errors->has('hire_date'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('hire_date') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="parent" class="col-form-label">{{ $employee->parent_id === null ? 'Parent for the root node cannot be changed' : 'Parent' }}</label>
                    <select id="parent" class="parent form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" name="parent" {{ $employee->parent_id === null ? ' disabled' : '' }}>
                        @isset($parent)
                            <option value="{{ $parent->id }}" selected>{{ $parent->full_name }}</option>
                        @endisset
                    </select>
                    @if ($errors->has('parent'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
                    @endif
                </div>

                <div class="form-check" {{ $employee->parent_id === null ? ' hidden' : '' }}>
                        <input type="checkbox" class="form-check-input" id="descendants">
                        <label class="form-check-label" for="descendants">Reassign descendants</label>
                </div>

                <div class="form-group" id="nparent" style="display: none; width: 100%;">
                    <label for="new__parent" class="col-form-label">Choose new parent for descendants</label>
                    <select style="width: 100%;" id="new__parent" class="new__parent form-control{{ $errors->has('new__parent') ? ' is-invalid' : '' }}" name="new__parent"></select>
                </div>

                <div class="form-group text-right">
                     <a href="{{ route('employee.show', $employee) }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @include('admin.employees._image')
        </div>
    </div>
@endsection