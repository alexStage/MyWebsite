@extends('layouts.layout')
@section('content')

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">{{$album->title}}</h1>
    <p class="lead text-muted">{{$album->content}}</p>
    <small>publié par: {{$album->user->name}}</small>
      <div class="panel-body">
      {{Form::open(['route'=>['albums.comment', $album]])}}   
        <div class="form-group">
          {{Form::label('content', 'laissez un commentaire:')}}
          {{Form::text('content',null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group"></div>
          {{Form::submit('Commenter',['class'=>'btn btn-primary form-control'])}}
        </div>
        
        {{Form::close()}}
    </div>
    <!--<div class="container">
      @foreach($album->comments as $comment)
        <p>{{$comment->content}}</p>
        <p>{{$comment->user->name}}</p>
      @endforeach
    </div>-->
  </div>
  @if(session('success'))
    <div class="container">
      <div class="alert alert-success">
        <strong>{{session('success')}}</strong> 
      </div>
    </div>
  @endif
</section>
	
<div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
      	@foreach($album->photos as $photo)
        <div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <img class="card-img-top" src="{{asset('storage/photos/'.$photo->name)}}" alt="Card image cap">
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

@stop