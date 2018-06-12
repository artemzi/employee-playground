@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5>&nbspBoss (as position title) is not an employee, but parent for each node (root element). So Boss isn't shown in the tree, but each employee has a chief.</h5>
            @if(!empty($boss))
                <p>In current migrations Boss is <strong>{{ $boss->full_name }}</strong> - ( title: {{ $boss->title->name }} )</p>
                <p><a href="{!! route('table') !!}">View in table</a></p>
            @endif
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Total employees in database: {{ $total }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div
                            class="d-flex justify-content-left"
                            id="tree"
                            data-url="{{ route('tree') }}"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        axios({
          method: 'post',
          url: '/tree',
        }).then(function (response) {
            let $tree = $('#tree');
            $tree.tree({
                data: response.data,
                selectable: false,
                dragAndDrop: true,
                onCreateLi: function(node, $li) {
                    $li.find('.jqtree-element').append(
                        ' - ( <span class="node_title" data-node-id="'+
                        node.id +'">' + node.title.name + '</span> )'
                    );
                }
            });
          })
          .catch(function (error) {
            console.log(error);
          });
    </script>
@endsection