<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'identifiant', 'title'
    ];

    public function voyages(){
        return $this->belongsToMany('App\Voyage');
    }

    public function photos(){
        return $this->hasMany('App\Photo');
    }

    public function albums(){
        return $this->hasMany('App\Album');
    }

}
