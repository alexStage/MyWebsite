<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Album;
use App\Comment;

class Photo extends Model
{
    protected $fillable = ['name','album_id'];

    public function album(){
    	return $this->belongsTo('App\Album');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }
}
