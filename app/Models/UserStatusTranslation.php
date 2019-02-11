<?php

namespace App\Models;

use Eloquent as Model;

class UserStatusTranslation extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name',
    ];

    public static $rules = [
        'name' => 'required|string|min:3'
    ];
}