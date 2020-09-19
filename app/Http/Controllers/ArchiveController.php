<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ArchiveController extends Controller
{
    public function index(){
        $directories = Storage::disk('archives')->directories();
        $files = Storage::disk('archives')->files();
        return view('archives.index', compact('files', 'directories'));
    }

    public function showDirectory($directory){
        $files = Storage::disk('archives')->files($directory);
        $directories = Storage::disk('archives')->directories($directory);
        return view('archives.index', compact('files', 'directories'));
    }
}
