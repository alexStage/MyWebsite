<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Photo;
use App\Comment;

class Album extends Model
{
    protected $fillable = ['title', 'content', 'ville', 'user_id', 'id', 'voyage_id', 'pays_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function photos(){
    	return $this->hasMany('App\Photo');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function etiquettes(){
        return $this->belongsToMany('App\etiquette');
    }

    public function pays(){
    	return $this->belongsTo('App\Pays');
    }

    public function voyage(){
    	return $this->belongsTo('App\Voyage');
    }
    
}
