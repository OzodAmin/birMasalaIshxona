<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStatus extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translationModel = 'App\Models\ProductStatusTranslation';

    public $table = 'product_status';

    public $timestamps = false;

    public $translatedAttributes = ['name'];

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
