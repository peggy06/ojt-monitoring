<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'department', 'supervisor'
    ];
}
