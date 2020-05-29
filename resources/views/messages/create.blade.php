@extends('layouts.layout')

@section('content')

<div class="container my-4">
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Laisser un message ;)</h3>
	</div>
	
	<div class="panel-body">
		{{Form::open(array('route' => 'messages.store'))}}
			<div class="form-group">
				{{Form::label('title', 'Titre du message:')}}
				{{Form::text('title',null, ['class'=>'form-control'])}}
			</div>
			<div class="form-group">
				{{Form::label('content', 'message:')}}
				{{Form::textarea('content',null, ['class'=>'form-control', 'rows'=>'3'])}}
			</div>
			<div class="form-group"></div>
				{{Form::submit('Publier',['class'=>'btn btn-primary form-control'])}}
			</div>
			
			{{Form::close()}}
	</div>


</div>
</div>
@stop