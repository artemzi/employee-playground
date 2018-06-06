@extends('layouts.app')

@section('content')
    <h4>Boss (as position title) is not an employee, but parent for each node (root element). So Boss isn't shown in the tree, but each employee has a chief.</h4>
    @if(!empty($boss))
        <p>In current migrations Boss is <strong>{{ $boss->full_name }}</strong> - ( title: {{ $boss->title->name }} )</p>
    @endif
    <p>Total employees in database: {{ $total }}</p>
    <hr>
    <div class="d-flex justify-content-center" id="tree"></div>
@endsection

@section('scripts')
    <script type="text/javascript">
        axios({
          method: 'post',
          url: '/tree',
        }).then(function (response) {
            // console.log(response.data);
            let $tree = $('#tree');
            $tree.tree({
                data: response.data,
                autoOpen: false,
                selectable: true,
                closedIcon: '+',
                openedIcon: '-',
                dragAndDrop: false,
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