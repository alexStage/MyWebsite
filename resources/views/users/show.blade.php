@extends('layouts.layout')
@section('content')
<p>zizi</p>
<div class="app">
    <photo-profile-form :data-user="{{json_encode($user)}}"></photo-profile-form>
</div>
<script src="js/app.js"></script>
@stop