<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use Session;

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

        $data = [
            'name' => $name,
            'email' => $email
        ];

        $validator = Validator::make($data,[
            'name' => ['required', 'string', 'max:255', 'alpha_num'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            Session::flash('danger', ' utilisateur non modifié !!! pas d\'espace dans les noms ou adresses');
            return back();
        }else{
            $user = DB::table('users')
              ->where('id', $id)
              ->update([
                  'name' => $name,
                  'email' => $email,
                  'family' => $family,
                  'admin' => $admin,
              ]);
              Session::flash('success', 'utilisateur modifié');
              return 'success';
        }

        
    }
}
