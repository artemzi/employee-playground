@extends('layouts.app')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <table class="table table-hover" id="employees-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
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
                { data: 'title', name: 'titles.name', title: 'Position' },
                { data: 'hire_date', name: 'hire_date' },
                { data: 'salary', name: 'salary' },
            ],
            initComplete: function () {
                this.api().columns().every(function () {
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
            let data = table.row(this).data();
            console.log(data);
        });
    });
    </script>
@endsection