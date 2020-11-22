@extends('layouts.layout')

@section('content')

@foreach($games as $game)

<p>{{$game->titre}}</p>
<p>{{$game->slug}}</p>

@endforeach

@stop