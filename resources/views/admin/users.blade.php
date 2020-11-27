@extends('layouts.layout')
@section('content')
<div id="app">
<users-list :data-users={{json_encode($users)}}></users-list>
</div>
<script src="js/app.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@stop