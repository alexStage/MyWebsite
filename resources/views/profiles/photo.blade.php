@extends('layouts.layout')

@section('content')

	<div class="panel-body">
		{{Form::open(array('route' => 'profile.edit','files'=>'true', 'enctype' =>'multipart/form-data','target' => '_self'))}}
			<div class="form-group">
				<div class="custom-file">
				<label class="custom-file-label" for="validatedCustomFile">Sélectionner votre photo de profile</label>
				<input type="file" class="custom-file-input" name="photo"/>
			</div>

			<div class="form-group ">
				{{Form::submit('Publier',['class'=>'btn btn-primary form-control'])}}
			</div>
			
		{{Form::close()}}
	</div>

@endsection