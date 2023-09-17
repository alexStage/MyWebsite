@extends('layouts.layout')
@section('content')
<div class="album py-5 bg-light">
    <div class="container">
        @foreach($voyages as $voyage)
        <div class="row mb-4 shadow-lg p-4 bg-white">
                <div class="col-md-2">
                    <p class="text-muted text-center">{{$voyage->users[0]->pseudo}}</p>
                    @if(isset($voyage->albums[0]->photos[0]->slug))
                    <img class="card-img-top" src="{{asset($voyage->users[0]->photoSlug)}}" alt="Card image cap">
                    @endif
                </div>
                <div class="col-md-6">
                    <h5 class="card-title">{{$voyage->title}}</h5>
                    <p class="d-inline">pays visités: </p>
                    @foreach($voyage->pays as $pay)
                        <p class="d-inline text-muted">{{$pay->title}}</p>
                    @endforeach
                    
                    <p class="card-text">{{$voyage->description}}</p>
                        
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a class="btn btn-sm btn-outline-secondary" target="_self" href="{{route('voyages.show', $voyage->id)}}">Voir</a>
                            @auth
                            @if(Auth::user()->admin)
                            <a class="btn btn-sm btn-outline-secondary" target="_self" href="{{route('voyages.edit', $voyage)}}">Modifier</a>
                            {{Form::open(['method'=>'DELETE', 'route'=>['voyages.destroy', $voyage], 'target'=>'_self'])}}
                                {{Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))}}
                                {{ Form::close() }}
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    <div class="pagination justify-content-center">{{$voyages->links()}}</div>
</div>
@stop