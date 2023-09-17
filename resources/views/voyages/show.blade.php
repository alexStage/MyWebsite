@extends('layouts/layout')
@section('content')
<div class="jumbotron text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-">
                <img src="{{$voyage->users[0]->photoSlug}}" height="100px" width="100pxpx" class="rounded-circle" alt="img">
            </div>
            <div class="col-lg- justify-content"></div>
                <h1 class="jumbotron-heading">{{$voyage->title}}</h1>
                <p class="lead text-muted">publié par: {{$voyage->users[0]->pseudo}}</p>
                <div class="panel-body">
                    <p class="lead-text">{{$voyage->description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop