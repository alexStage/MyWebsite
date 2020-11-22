@extends('layouts.layout')
@section('content')

<div class="container-fluid text-center">
    <div class="row">
            <div class="col-sm-3">
                @if(!empty($directories) && preg_match('#/#',$directories[0]))
                    <div class="row">
                        <a target="_self" href=".."><img src="{{asset('assets/folder.png')}}" width="12.8" height="12.8">Précédent</a> 
                    </div>
                @endif
                <?php
                if(isset($directories[0])){
                $directory = $directories[0];
                ?>
                <div class="row" id="{{$directories[0]}}">
                    <a target="_self" href="{{route('archives.showDirectory', compact('directory'))}}"><img src="{{asset('assets/folder.png')}}" alt="{{$directory}}" width="12.8" height="12.8">{{$directories[0]}}</a> 
                </div>
                <?php
                } ?>
                <?php
                    for($i=1; $i<count($directories); $i++){
                        $dossier = explode('/', $directories[$i-1]);
                        $delimiter = $dossier[0];
                        if(preg_match('#'.$delimiter.'#',$directories[$i])){
                            $directory = $directories[$i];
                        ?>
                            <div class="row" id="{{$delimiter}}">
                                <a target="_self" href="{{route('archives.showDirectory', compact('directory'))}}"><img src="{{asset('assets/folder.png')}}" alt="{{$directory}}" width="12.8" height="12.8">{{$directories[$i]}}</a> 
                            </div>
                        <?php
                        }else{
                            $directory = $directories[$i];
                            ?>
                            <div class="row" id="{{$directories[$i]}}">
                                <a target="_self" href="{{route('archives.showDirectory', compact('directory'))}}"><img src="{{asset('assets/folder.png')}}" alt="{{$directory}}" width="12.8" height="12.8">{{$directories[$i]}}</a> 
                            </div>
                            <?php
                        }
                    }
                ?>
        
            </div>
        <div class="col-sm-9">
            <div class="row">
                @foreach($files as $file)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <a href="{{Storage::disk('archives')->url($file)}}" target="_self"><img class="card-img-top" src="{{Storage::disk('archives')->url($file)}}" alt="Card image cap"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



@stop