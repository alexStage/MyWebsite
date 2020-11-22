<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etiquette;

class EtiquetteController extends Controller
{
    public function create(Request $request){
        $eti = Etiquette::create([
            'name' => $request->etiquette,
        ]);
        return $eti;
    }
}
