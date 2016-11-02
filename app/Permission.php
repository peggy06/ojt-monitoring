<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id', 'request', 'to', 'deleted', 'accepted', 'new'
    ];
}
