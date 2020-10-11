@extends('layouts.layout')
@section('content')
    <div id="app">
        <arborescence :data-directories={!!json_encode($directories)!!} :data-files={!!json_encode($files)!!}></arborescence>
    </div>
<script src="js/app.js"></script>
@stop