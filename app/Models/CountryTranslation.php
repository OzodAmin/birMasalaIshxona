<?php

namespace App\Models;

use Eloquent as Model;

class CountryTranslation extends Model {

    public $table = 'country_translations';
    public $timestamps = false;
    public $fillable = ['title'];
    public static $rules = ['title' => 'required|string|min:1'];
}
