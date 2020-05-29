@extends('layouts.layout')

@section('content')

@foreach($games as $game)

<p>{{$game->titre}}</p>
<p>{{$game->slug}}</p>
<img src="/home/dhaene/Images/disney/{{$game->photo}}">

@endforeach

@stop