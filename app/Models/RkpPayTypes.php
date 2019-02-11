<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RkpPayTypes extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'rkp_pay_types';

    public $translationModel = 'App\Models\RkpPayTypesTranslation';

    public $translatedAttributes = [
        'name',
    ];

    public $timestamps = false;

    protected $fillable = ['icon', 'code'];

    public static $rules = [
        'ru.name' => 'required|string|min:1|max:255',
        'uz.name' => 'required|string|min:1|max:255',
        'en.name' => 'required|string|min:1|max:255'
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($item) {
            $item->deleteTranslations();
        });
    }
}