<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Photo;
use App\Comment;

class Album extends Model
{
    protected $fillable = ['title', 'content', 'user_id','id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function photos(){
    	return $this->belongsToMany('App\Photo');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function etiquettes(){
        return $this->belongsToMany('App\etiquette');
    }
    
}
