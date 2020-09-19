@extends('layouts.layout')
@section('content')

@foreach($files as $file)
    <div class="container-fluid text-center">
        <a href="{{asset($file)}}" download="{{$file}}">{{$file}}</a>
    </div>
@endforeach

@stop