<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class DownloadController extends Controller
{
    public function index(){
        $files = Storage::disk('downloads')->allFiles();
        return view('downloads.show', compact('files'));
    }
}
