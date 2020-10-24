<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Album;
use App\Comment;

class Photo extends Model
{
    protected $fillable = ['name','album_id', 'user_id'];

    protected $with = ['etiquettes'];

    public function album(){
    	return $this->belongsTo('App\Album');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function etiquettes(){
        return $this->belongsToMany('App\Etiquette');
    }
}
