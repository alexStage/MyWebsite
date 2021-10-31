@extends('layouts.layout')
@section('content')
<div id="app">
<photos-admin :data-maj="{{json_encode($maj)}}" :data-count="{{json_encode($count)}}" :data-photos="{{json_encode($photos)}}" :data-etiquettes="{{json_encode($etiquettes)}}"></photos-admin>
</div>

@if($maj['missing']!=0||$maj['toDelete']!=0)
</br>
    <div class="alert alert-warning text-center container" role="alert">
        {{$maj['missing']}} photos à ajouter et {{$maj['toDelete']}} photos à supprimer.
        <div class="container-fluid text-center">
            <a target="_self" href="{{ route('MAJBDD')}}"><button class="btn  btn-primary">Mettre à jour la BDD</button></a>
        </div>
    </div>
@endif

<script src="js/app.js"></script>

@include('layouts/footer')

@stop