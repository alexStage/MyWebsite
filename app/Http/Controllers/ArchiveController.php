<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Closure;
use Illuminate\Support\Arr;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class ArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('Family');
    }

    public function index($directory = null){
        $directories = Storage::disk('archives')->allDirectories();
        if($directory == null){
            $files = Storage::disk('archives')->files($directories[0]);
        }else{
            $files = Storage::disk('archives')->files($directory);
        }
        foreach($directories as $directory){
            $content = Storage::disk('archives')->files($directory);
            if($content == NULL){
                unset($directories[array_search($directory, $directories)]);
            }
        }
        return view('archive.index', compact('files', 'directories'));
    }

    public function listDirectories($directory = null){
        $directories = Storage::disk('archives')->allDirectories();
        if($directory == null){
            $files = Storage::disk('archives')->files($directories[0]);
        }else{
            $files = Storage::disk('archives')->files($directory);
        }
        foreach($directories as $directory){
            $content = Storage::disk('archives')->files($directory);
            if($content == NULL){
                unset($directories[array_search($directory, $directories)]);
            }
        }

        return $directories;
    }

    public function getDirectories($directory = "/"){
        $files = Storage::disk('archives')->files($directory);
        $directories = Storage::disk('archives')->directories($directory);
        for($i=0; $i<=count($files)-1; $i++){
            $files[$i] = "archive/".$files[$i];
        }
        $collection = collect($files);
        $perPage = 15;

        $files = new LengthAwarePaginator(
            $collection->forPage(1, $perPage),
            $collection->count(),
            $perPage,
        );

        return compact('directories', 'files');
    }

    public function getPagination($directory = null, $page=1){
        $directories = Storage::disk('archives')->Directories();
        if($directory == null){
            $files = Storage::disk('archives')->files($directories[0]);
        }else{
            $files = Storage::disk('archives')->files($directory);
            $directories = Storage::disk('archives')->directories($directory);
        }

        for($i=0; $i<=count($files)-1; $i++){
            $files[$i] = "archive/".$files[$i];
        }
        $collection = collect($files);
        $perPage = 15;

        $files = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
        );

        return compact('directories', 'files');
    }

}
