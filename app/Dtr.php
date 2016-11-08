<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dtr extends Model
{
    protected $fillable = [
        'date', 'user_id', 'status', 'week_no'
    ];
}
