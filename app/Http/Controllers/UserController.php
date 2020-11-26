<?php

namespace App\Http\Controllers;

use Illmuinate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function getUser($id){
        $user = User::where('id', '=', $id)->first();
        return $user;
    }

    public function update($id,$name, $email, $family, $admin){

        if($admin == "true" || $admin == 1){
            $admin = 1;
        }else{
            $admin = 0;
        }

        if($family == "true" || $family == 1){
            $family = 1;
        }else{
            $family = 0;
        }
        
        $user = DB::table('users')
              ->where('id', $id)
              ->update([
                  'name' => $name,
                  'email' => $email,
                  'family' => $family,
                  'admin' => $admin,
              ]);
        
        return 'success';
    }
}
