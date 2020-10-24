@extends('layouts.layout')
@section('content')
<div id="app">
<photos-admin :data-photos="{{json_encode($photos)}}" :data-etiquettes="{{json_encode($etiquettes)}}"></photos-admin>
</div>
<script src="js/app.js"></script>
@stop