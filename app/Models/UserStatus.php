<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UserStatus extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'users_statuses';

    public $translatedAttributes = [
        'name',
    ];

    public static $rules = [
        'ru.name' => 'required|string|min:3|max:255',
        'uz.name' => 'required|string|min:3|max:255',
        'en.name' => 'required|string|min:3|max:255',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($city) {
            $city->deleteTranslations();
        });
    }
}
