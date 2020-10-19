@extends('layouts.layout')


@section('content')
<main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Albums :</h1>
          <p class="lead text-muted">Albums souvenirs de voyage ;)</p>
          <p>
            <a href="{{route('albums.create')}}" class="btn btn-primary my-2" target="_self">Créer un album</a>
            <!--<a href="#" class="btn btn-secondary my-2">Secondary action</a>-->
          </p>
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
          	@foreach($albums as $album)
            <div class="col-md-4 ">
              <div class="card mb-4 shadow-lg p-4 mb-4 bg-white">
                @if(isset($album->photos[0]))
                <img class="card-img-top" src="{{asset($album->photos[0]->name)}}" alt="Card image cap">
                @endif
                <div class="card-body">
                  <p class="card-text">{{$album->content}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a class="btn btn-sm btn-outline-secondary" target="_self" href="{{route('albums.show', $album)}}">Voir</a>
                      @auth
                      @if(Auth::user()->id == $album->user->id || Auth::user()->is_admin)
                      <a class="btn btn-sm btn-outline-secondary" target="_self" href="{{route('albums.edit', $album)}}">Modifier</a>
                      {{Form::open(['method'=>'DELETE', 'route'=>['albums.destroy', $album], 'target'=>'_self'])}}
                          {{Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))}}
                        {{ Form::close() }}
                      @endif
                      @endauth
                    </div>
                    <small class="text-muted">{{$album->user->name}}</small>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      <div class="pagination justify-content-center">{{$albums->links()}}</div>

      </div>
</main>



@stop
