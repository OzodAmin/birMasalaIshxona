<?php

namespace App\Models;

use Eloquent as Model;

class ProductStatusTranslation extends Model
{
    public $timestamps = false;
    public $table = 'product_statuses_translations';
    public $fillable = ['name'];
    public static $rules = ['name' => 'required|string|min:3'];
}