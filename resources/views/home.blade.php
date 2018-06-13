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

                     <div class="loading">
                        <div class="spinner">
                            <div class="mask">
                                <div class="maskedCircle"></div>
                            </div>
                        </div>
                    </div>
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
        let $tree = $('#tree');
        axios({
          method: 'post',
          url: '/tree',
        }).then(function (response) {
            $tree.tree({
                data: response.data,
                selectable: false,
                dragAndDrop: true,
                autoOpen: false,
                useContextMenu: false,

                onCreateLi: function(node, $li) {
                    $li.find('.jqtree-element').append(
                        ' - ( <span class="node_title" data-node-id="'+
                        node.id +'">' + node.title + '</span> )'
                    );
                }
            });
          }).catch(function (error) {
            console.log(error);
          });

        $spinner = $(".loading");
	    $spinner.toggle();
        // move category
        $tree.bind("tree.move", function (e) {
            $spinner.toggle();
            e.preventDefault();
            axios({
                method: "POST",
                url: '/tree/move',
                data: {
                    "action": "moveCategory",
                    "id": e.move_info.moved_node.id,
                    "parent_id": e.move_info.moved_node.parent_id,
                    "to": e.move_info.target_node.id,
                    "name": e.move_info.moved_node.name,
                    "direction": e.move_info.position
                }
            }).then(function (reponse) {
                $spinner.toggle();
                e.move_info.do_move();
                e.move_info.moved_node["parent_id"] = (e.move_info.position == "inside")
                    ? e.move_info.target_node["id"]
                    : e.move_info.target_node["parent_id"];
            }).catch(function (error) {
                $spinner.toggle();
                console.error(error.message);
            });
        }); // END move
    </script>
@endsection