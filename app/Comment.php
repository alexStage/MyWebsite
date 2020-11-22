<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['content','user_id','photo_id','album_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
