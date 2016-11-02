<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'chat_id', 'sender', 'receiver', 'message', 'new', 'seen', 'deleted'
    ];
}
