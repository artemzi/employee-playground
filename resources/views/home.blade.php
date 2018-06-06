@extends('layouts.app')

@section('content')
    <h4>Boss (as position title) is not an employee, but parent for each node. So Boss isn't shown in the tree, but each employee has a chief.</h4>
    @if(!empty($boss))
        <p>In current migrations Boss is {{ $boss->full_name }} - ( {{ $boss->title->name }} )</p>
    @endif
    <hr>
    <div id="tree"></div>
@endsection
