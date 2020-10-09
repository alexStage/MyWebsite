@extends('layouts.layout')
@section('content')


<div class="d-flex" id="wrapper">
   <div id="folder-list" class="list-group list-group-flush sticky">
        @foreach($directories as $directory)
            <a class="list-group-item list-group-item-action bg-light" target="_self" href="{{route('archives.showDirectory', compact('directory'))}}"><img src="{{asset('assets/folder.png')}}" alt="{{$directory}}" width="12.8" height="12.8">{{$directory}}</a>
        @endforeach
      </div>

    <div id="page-content-wrapper">
    <button class="btn btn-primary" id="menu-toggle">dossiers</button>
        @if(isset($files))
        <div class="container-fluid text-center">
            <div class="row">
                @foreach($files as $file)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <a href="{{Storage::disk('archives')->url($file)}}"><img class="card-img-top" src="{{Storage::disk('archives')->url($file)}}" alt="Card image cap"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<script src="{{asset('js/button-folder.js')}}"></script>
@stop