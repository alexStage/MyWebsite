@extends('layouts.layout')
@section('content')

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">{{$album->title}}</h1>
    <p class="lead text-muted">{{$album->content}}</p>
    <small>publié par: {{$album->user->name}}</small>
    <center>
      {{Form::open(array('route' => array('albums.update', $album),'files'=>'true', 'enctype' =>'multipart/form-data','target' => '_self'))}}
        @method('PUT')
        <div class="custom-file">
        <label class="custom-file-label" for="validatedCustomFile">Ajouter des photos</label>
        <input type="file" class="custom-file-input" name="photos[]" multiple="multiple" />
      </div>
      <div class="form-group ">
        {{Form::submit('Publier',['class'=>'btn btn-primary form-control'])}}
      </div>
      {{Form::close()}}
      <!--<a href="#" class="btn btn-secondary my-2">Secondary action</a>-->
    </center>
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