<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class DownloadController extends Controller
{
    public function index(){
        $files = Storage::files('public');
        return view('downloads.show', compact('files'));
    }
}
