@extends('layouts.app')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <table class="table table-bordered" id="employees-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Title</th>
                    <th>Hire Date</th>
                    <th>Salary (RUB)</th>
                </tr>
            </thead>
        </table>

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(function() {
        $('#employees-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('datatables.data') !!}',
                method: 'get',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'full_name', name: 'full_name' },
                { data: 'title', name: 'title' },
                { data: 'hire_date', name: 'hire_date' },
                { data: 'salary', name: 'salary' },
            ]
        });
    });
    </script>
@endsection