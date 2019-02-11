<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'country';
    public $translationModel = 'App\Models\CountryTranslation';
    public $translatedAttributes = ['title'];
    public $timestamps = false;

    public static $rules = [
        'ru.title' => 'required|string|min:1|max:255',
        'uz.title' => 'required|string|min:1|max:255',
        'en.title' => 'required|string|min:1|max:255',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->deleteTranslations();
        });
    }
}