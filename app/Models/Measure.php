<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Measure extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'measurement';

    public $translationModel = 'App\Models\MeasureTranslation';

    public $translatedAttributes = [
        'title',
        'title_short',
        'slug',
    ];

    public $timestamps = false;

    public static $rules = [
        'ru.title' => 'required|string|min:1|max:255',
        'uz.title' => 'required|string|min:1|max:255',
        'en.title' => 'required|string|min:1|max:255',
        'ru.title_short' => 'required|string|min:1|max:255',
        'uz.title_short' => 'required|string|min:1|max:255',
        'en.title_short' => 'required|string|min:1|max:255',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->deleteTranslations();
        });
    }
}