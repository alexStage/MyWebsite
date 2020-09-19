@extends('layouts.layout')
@section('content')

<div class="container">
    <div class="row">
        @foreach($directories as $directory)
            <!--<a target="_self" href="archive/{{$directory}}"><img src="{{asset('assets/folder.png')}}" alt="{{$directory}}" width="128" height="128"></a>-->
            <a target="_self" href="{{route('archives.showDirectory', compact('directory'))}}"><img src="{{asset('assets/folder.png')}}" alt="{{$directory}}" width="128" height="128"></a>
        @endforeach
    </div>
</div>



<div class="container">
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



@stop