@extends('layouts.layout')
@section('content')
</br>   
<div class="container">
<ul class="list-group">
  <li class="list-group-item"><a href="{{route('admin.users')}}" target="_self" >administrer les utilisateurs</a></li>
  <li class="list-group-item"><a href="{{route('admin.photos')}}" target="_self" >administrer les photos</a></li>
</ul>
</div>

@include('layouts/footer')

@stop