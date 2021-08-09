@extends('layouts.layout')
@section('content')

<section class="jumbotron text-center">
  <div class="container">
    {{Form::open(array('route' => array('albums.update', $album), 'method' => 'put'))}}
    <div class="form-group">
    {{Form::label('title', 'Nom de l\'album')}}
    {{Form::text( 
            'title', 
            $album->title , 
            array( 'class' => 'form-control', 'id' => 'title', 'placeholder' => 'titre' ))}}
    </div>
    <div class="form-group">
    {{Form::label('content', 'description de l\'album')}}
    {{Form::textarea( 
            'content', 
            $album->content , 
            array( 'class' => 'form-control', 'rows' => '2', 'id' => 'content', 'placeholder' => 'description' ))}}
    </br>
    {{Form::button('<a>modifier l\'album</a>', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
    {{Form::close()}}
    </div>
  <small>publié par: {{$album->user->name}}</small>
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
            <img class="card-img-top" src="{{asset($photo->slug)}}">
            @if(Auth::user()->id == $album->user->id || Auth::user()->is_admin)
              {{Form::open(['method'=>'DELETE', 'route'=>['photos.destroy', $photo], 'target'=>'_self'])}}
                {{Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))}}
              {{ Form::close() }}
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

@stop