<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'bday', 'gender', 'course', 'major', 'contact', 'company_id', 'number_of_hours_rendered', 'department', 'avatar','bday'
    ];
}
