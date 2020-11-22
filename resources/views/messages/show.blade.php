@extends('layouts.layout')

@section('content')

<div id="app">
    <message-form :data-messages={{$messages}}></message-form>
</div>

<script src="/js/app.js"></script>

@stop