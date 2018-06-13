@extends('layouts.app')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col text-right">
            <p><a href="{{ route('employees.create') }}" class="btn btn-success">Add Employee</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-hover justify-content-center" id="employees-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th id="avatar">Avatar</th>
                        <th>Title</th>
                        <th>Hire Date</th>
                        <th>Salary (RUB)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(function() {
        let table = $('#employees-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'ltipr',
            ajax: {
                url: '{!! route('datatables.data') !!}',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'full_name', name: 'full_name' },
                { data : 'image',
                    render : function(data, type, row) {
                        if (data === '') return '';
                        return "<image class=\"rounded mx-auto d-block\" src=' " + data + "' />";
                    }, name: 'employees.id'
                },
                { data: 'title', name: 'titles.name', title: 'Position' },
                { data: 'hire_date', name: 'hire_date' },
                { data: 'salary', name: 'salary' },
            ],
            initComplete: function () {
                this.api().columns([0,1,3,4,5]).every(function () {
                    let column = this;
                    let input = document.createElement("input");
                    input.className = 'form-control';
                    $(input).appendTo($(column.footer()).empty())
                    .on('input', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            }
        });
        table.on('click', 'tr', function () {
            let row = table.row(this).data();
            if (row !== undefined) {
                window.location.href = `employee/${row.id}`;
            }
        });
    });
    </script>
@endsection