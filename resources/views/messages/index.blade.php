@extends('layouts.layout')

@section('content')

<main role="main">
      <section class="jumbotron text-center">
          <h1 class="jumbotron-heading">Messages :</h1>
          <p class="lead text-muted">Petits messages ;)</p>
          <center>
              {{Form::open(array('route' => 'messages.store','target' => '_self'))}}
                <div class="form-group col-6">
                  {{Form::text('content',null, ['class'=>'form-control'])}}
                </div>
                <div class="form-group col-2">
                  {{Form::submit('Laisser un message',['class'=>'btn btn-primary form-control'])}}
                </div>
              {{Form::close()}}
              <!--<a href="#" class="btn btn-secondary my-2">Secondary action</a>-->
          </center>
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

      <div class="album py-5 bg-light">
        <div class="container">
          @foreach($messages as $message)
          <div class="media border p-3">
            <!--<img src="{{asset('storage/photos/'.$message->user->photo->name)}}" class="mr-3 mt-3 rounded-circle" style="width:60px;">-->
            <div class="media-body">
              <h4>{{$message->user->name}}<small><i> Posté le: {{$message->created_at}}</i></small></h4>
              <p>{{$message->content}}</p>
              <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      @if(Auth::user()->id == $message->user->id || Auth::user()->is_admin)
                        {{Form::open(['method'=>'DELETE', 'route'=>['messages.destroy', $message], 'target'=>'_self'])}}
                          {{Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))}}
                        {{ Form::close() }}
                      @endif
                    </div>
                  </div>      
            </div>
          </div>
          @endforeach

        </div>
      </div>
</main>

@stop