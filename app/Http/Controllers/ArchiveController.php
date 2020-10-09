<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Closure;
use Illuminate\Support\Arr;

class ArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('Family');
    }
     
    public function index(){
        $directories = Storage::disk('archives')->allDirectories();
        foreach($directories as $directory){
            $files = Storage::disk('archives')->files($directory);
            if($files == NULL){
                unset($directories[array_search($directory, $directories)]);
            }
        }
        return view('archive.index', compact('directories'));
    }

    public function showDirectory($directory){
        $files = Storage::disk('archives')->files($directory);
        $directories = Storage::disk('archives')->allDirectories();
        foreach($directories as $directory){
            $content = Storage::disk('archives')->files($directory);
            if($content == NULL){
                unset($directories[array_search($directory, $directories)]);
            }
        }

        return view('archive.index', compact('files', 'directories'));
    }

    public function getDirectories(){
        $directories = Storage::disk('archives')->allDirectories();
        return $directories;
    }
    public function getSubDirectories($directory){
        $directories = Storage::disk('archives')->directories($directory);
        $files = Storage::disk('archives')->files($directory);
        $path = Storage::path($directory);
        return $directories;        
    }
}
