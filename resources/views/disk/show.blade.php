@extends('layouts.layout')
@section('content')

@foreach($files as $file)
    <p>{{$file}}</p>
    <img src="{{asset($file)}}" width="60" height="60" alt="">
@endforeach

@foreach($urls as $url)
    <p>{{$url}}</p>
    <img src="{{asset($url)}}" width="60" height="60" alt="">
    <img src="{{'storage/test.JPG'}}" width="60" height="60" alt="">
@endforeach

@stop