<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable =[
        'user_id', 'signature', 'role'
    ];
}
