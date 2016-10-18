<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{

    /**
     * fillable fields for verifications
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'code', 'used'
    ];
}
