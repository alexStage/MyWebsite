<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index',compact('games'));

    }

    public function game1(){
    	return view('games.game1');
    }
}
