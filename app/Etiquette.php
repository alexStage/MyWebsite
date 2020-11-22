<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiquette extends Model
{
    protected $fillable = ['name'];

    public function photos(){
        return $this->belongsToMany('App\Photo');
    }

    public function albums(){
        return $this->belongsToMany('App\Album');
    }
}
