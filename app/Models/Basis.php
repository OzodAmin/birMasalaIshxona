<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Basis extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'basis';

    public $translationModel = 'App\Models\BasisTranslation';

    public $translatedAttributes = [
        'title',
        'slug',
    ];

    public $timestamps = false;

    protected $fillable = ['icon', 'code'];

    public static $rules = [
        'ru.title' => 'required|string|min:1|max:255',
        'uz.title' => 'required|string|min:1|max:255',
        'en.title' => 'required|string|min:1|max:255',
        'code' => 'required|string|min:1|max:20',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->deleteTranslations();
        });
    }
}