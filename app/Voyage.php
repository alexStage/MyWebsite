<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'title', 'description', 'dateDeDebut','dateDeFin'
    ];

    public function albums(){
    	return $this->hasMany('App\Album');
    }

    public function pays(){
        return $this->belongsToMany('App\Pays');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
