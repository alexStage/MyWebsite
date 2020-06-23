<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use Redirect;

class ProfileController extends Controller
{
    
    public function edit(Request $request){
       $user = Auth::user();
        if($request->hasFile('photo')){ 
            $photoName = $request->photo->getClientOriginalName();
            $name = now().$photoName;
            $filename = $request->photo->move(public_path('storage/photos/'),$name);
            Photo::create([
                'name' => $name,
                'user_id' =>$user->id,
                ]);
        }
        
        return redirect(route('albums.index'));
    
    }

    public function photo(){
        return view('profiles.photo');
    }

}
