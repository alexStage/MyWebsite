<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Album;
use App\Message;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin','id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        return $this->admin; // retourne vrai ou faux selon le boolean admin dans la base
    }

    public function isFamily(){
        return $this->family; // retourne vrai ou faux selon le boolean family dans la base
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function albums(){
        return $this->hasMany('App\Album'); 
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function photo(){
        return $this->hasOne('App\Photo');
    }

}
