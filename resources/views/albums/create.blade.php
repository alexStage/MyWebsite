@extends('layouts.layout')


@section('content')
<div class="container my-4">
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Créer un nouvel album</h3>
	</div>
	
	<div class="panel-body">
		{{Form::open(array('route' => 'albums.store','files'=>'true', 'enctype' =>'multipart/form-data','target' => '_self'))}}
			@csrf
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
	</div>

			<div class="form-group ">
				{{Form::submit('Publier',['class'=>'btn btn-primary form-control'])}}
			</div>
			
		{{Form::close()}}

	</div>

	<div class="progress">
		<div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
	</idv>

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

<script>
	$(document).ready(function(){
		$('form').ajaxForm({
			beforeSend:function(){
				$('#success').empty();
				$('.progress-bar').text('0%');
				$('.progress-bar').css('width', '0%');
			},
			uploadProgress:function(event, position, total, percentComplete){
				$('.progress-bar').text(percentComplete + '%');
				$('.progress-bar').css('width', percentComplete +'%');
			},
			success:function(data){
				if(data.success){
					$('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
					$('.progress-bar').text('Uploaded');
					$('.progress-bar').css('width', '100%');
				}
			}
		})
	});
</script>
@stop