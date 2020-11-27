@extends('layouts.layout')

@section('content')

<section class="jumbotron text-center">
  <h1 class="jumbotron-heading">Derniers messages et le dernier album publié</h1>
  <p class="lead text-muted">les trucs les plus récents</p>
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
      </ul>
    </div>
  @endif
  
  @if(session('success'))
  <div class="container">
    <div class="alert alert-success">
      <strong>{{session('success')}}</strong> 
    </div>
  </div>
@endif
</section>



    @if(isset($album))
    <div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
    <div class="col-md-4">
      <div class="card mb-4 box-shadow">
        @if(isset($album->photos[0]))
        <img class="card-img-top" src="{{asset('storage/photos/'.$album->photos[0]->name)}}" alt="Card image cap">
        @endif
        <div class="card-body">
          <p class="card-text">{{$album->content}}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a class="btn btn-sm btn-outline-secondary" target="_self" href="{{route('albums.show', $album)}}">Voir</a>
              @if(Auth::user()->id == $album->user->id || Auth::user()->is_admin)
              <a class="btn btn-sm btn-outline-secondary" target="_self" href="{{route('albums.edit', $album)}}">Modifier</a>
              {{Form::open(['method'=>'DELETE', 'route'=>['albums.destroy', $album], 'target'=>'_self'])}}
                  {{Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))}}
                {{ Form::close() }}
              @endif
            </div>
            <small class="text-muted">{{$album->user->name}}</small>
          </div>
        </div>
      </div>

    </div>
    @if(isset($message))
    <div class="col-md-4">
      <div class="card mb-4 box-shadow">
        <div class="card-body">
          <p class="card-text">{{$message->content}}</p>
          <p class="card-text">{{$message->title}}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              @if(Auth::user()->id == $message->user->id || Auth::user()->is_admin)
                {{Form::open(['method'=>'DELETE', 'route'=>['messages.destroy', $message], 'target'=>'_self'])}}
                  {{Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))}}
                {{ Form::close() }}
              @endif
            </div>
            <small class="text-muted">Signé: {{$message->user->name}}</small>
          </div>
        </div>
      </div>
    </div>
    @endif 
    </div>
    </div>
    </div>
    @endif

    
    @include('layouts/footer')

        
@endsection
