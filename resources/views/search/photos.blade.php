@extends('layouts.layout')
@section('content')
<div id="app">
<photos-search :data-etiquettes="{{json_encode($etiquettes)}}"></photos-search>
</div>

<script src="js/app.js"></script>
<!-- <script src="{{ asset('js/baguetteBox.min.js') }}" ></script>
<script> baguetteBox.run('.tz-gallery') </script> -->
@include('layouts/footer')

@stop