@extends('layouts.layout')
@section('content')
<div id="app">
<users-list :data-users={!!json_encode($users)!!}></users-list>
</div>
<script src="js/app.js"></script>
@stop