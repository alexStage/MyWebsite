@extends('layouts.layout')
@section('content')
<div id="app">
<photos-admin :data-photos="{{json_encode($photos)}}" :data-etiquettes="{{json_encode($etiquettes)}}"></photos-admin>
</div>

<div class="container-fluid text-center">
    <a target="_self" href="{{ route('MAJBDD')}}"><button class="btn  btn-primary">Mettre à jour la BDD</button></a>
</div>
<script src="js/app.js"></script>

@include('layouts/footer')

@stop