@extends('layouts.layout')
@section('content')
<div id="app">
<photos-search :data-etiquettes="{{json_encode($etiquettes)}}"></photos-search>
</div>

<script src="js/app.js"></script>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
    //$("#btnIcon").toggleClass("fas fa-angle-double-right");
    if(document.getElementById('btnIcon').className=="fas fa-angle-double-left"){
        document.getElementById('btnIcon').className="fas fa-angle-double-right";
    }else if(document.getElementById('btnIcon').className=="fas fa-angle-double-right"){
        document.getElementById('btnIcon').className="fas fa-angle-double-left";
    }
    $("#wrapper").toggleClass("toggled");
    });
</script>
<!-- <script src="{{ asset('js/baguetteBox.min.js') }}" ></script>
<script> baguetteBox.run('.tz-gallery') </script> -->
@include('layouts/footer')

@stop