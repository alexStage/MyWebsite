<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Album;

class Photo extends Model
{
    protected $fillable = ['name','album_id'];

    public function album(){
    	return $this->belongsTo('App\Album');
    }
}
