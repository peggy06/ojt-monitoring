<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
        'user_id', 'date_started', 'date_finished', 'deleted'
    ];
}
