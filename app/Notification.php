<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable =[
        'to', 'event', 'post_id', 'poser', 'event', 'removed', 'accepted', 'deleted'
    ];
}
