@extends('layouts.layout')


@section('content')
<div class="container my-4">
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Créer un nouvel album</h3>
	</div>
	
	<div class="panel-body">
		{{Form::open(array('route' => 'albums.store','files'=>'true', 'enctype' =>'multipart/form-data','target' => '_self'))}}

			<div class="form-group">
				{{Form::label('title', 'Intitulé de l\'album:')}}
				{{Form::text('title',null, ['class'=>'form-control'])}}
			</div>
			<div class="form-group">
				{{Form::label('content', 'descriptif de l\'album:')}}
				{{Form::textarea('content',null, ['class'=>'form-control', 'rows'=>'3'])}}
			</div>
			<div class="form-group">
				<div class="custom-file">
				<label class="custom-file-label" for="validatedCustomFile">Sélectionner les photos</label>
				<input type="file" class="custom-file-input" name="photos[]" multiple="multiple" />
			</div>
	</div>

			<div class="form-group ">
				{{Form::submit('Publier',['class'=>'btn btn-primary form-control'])}}
			</div>
			
		{{Form::close()}}

	</div>
	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<p>{{$error}}</p>
				@endforeach
			</ul>
		</div>
	@endif
</div>
</div>
@stop