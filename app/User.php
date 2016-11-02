<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'name', 'email', 'password', 'under_to', 'confirmed', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function signatures(){
        return $this->hasOne('App\Signature');
    }

    public function verification(){
        return $this->hasOne('App\Verification');
    }

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function logs(){
        return $this->hasMany('App\Log');
    }
}
