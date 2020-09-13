<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function index(){
        $files = Storage::files('public');
        $urls =[];
        foreach($files as $file){
            $url = Storage::url($file);
            array_push($urls, $url);
        }
        return view('disk.show', compact('files', 'urls'));
    }
}
