<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use App\Etiquette;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function AdminPhotos(){
        $photos = Photo::all();
        $etiquettes = Etiquette::all();
        return view('admin.photos', compact('photos', 'etiquettes'));
    }

    public function AdminUsers(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function adminEtiquette(Request $request){
        $photo = Photo::where('id', '=', $request->photo['id'])->first();
        $etiquettes = $request->etiquettes;
        foreach($etiquettes as $etiquette){
            $eti = Etiquette::where('id', '=', $etiquette['id'])->first();
            $photo->etiquettes()->save($eti);
        }
    }
}
