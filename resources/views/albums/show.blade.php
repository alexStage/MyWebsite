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

  @if(session('success'))
    <div class="container">
      <div class="alert alert-success">
        <strong>{{session('success')}}</strong> 
      </div>
    </div> 
  @endif
</section>

    <div class="container-fluid text-center">
      <div class="row">
	     <div class="col">
        <div class="album py-5 bg-light">
          <div class="container">
            <div class="row">
              @foreach($album->photos as $photo)
              <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                  <a href="{{asset($photo->slug)}}"><img class="card-img-top" src="{{asset($photo->slug)}}" alt="Card image cap"></a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @if($album->comments()->count() >= 1)
        <div class="row">
          <div class="col">
            <h1>Commentaires</h1>
            @foreach($album->comments as $comment)
            <div class="media border p-3">
              <div class="media-body">
                  <h4>{{$comment->user->name}}<small><i> posté le: {{$comment->created_at}}</i></small></h4>
                  <p>{{$comment->content}}</p>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endif
    </div>
    <script src="/js/app.js"></script>
@stop