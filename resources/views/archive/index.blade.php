@extends('layouts.layout')
@section('content')
    <div id="app">
        <directories-item :data-directories={!!json_encode($directories)!!}></directories-item>
    </div>
<script src="js/app.js"></script>
<script src="{{asset('js/button-folder.js')}}"></script>
@stop