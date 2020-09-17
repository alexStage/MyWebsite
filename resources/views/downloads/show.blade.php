@extends('layouts.layout')
@section('content')

<div class="container-fluid text-center">
    <a href="{{asset('storage/downloads/mulan.mkv')}}" download="mulan.mkv"><img src="{{asset('storage/downloads/affiche_mulan.webp')}}" width="210" height="280"></a>
</div>

@foreach($files as $file)
    <img src="{{asset($file)}}">
    
@endforeach

@stop