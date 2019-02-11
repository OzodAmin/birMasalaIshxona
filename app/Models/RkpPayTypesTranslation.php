<?php

namespace App\Models;

use Eloquent as Model;

class RkpPayTypesTranslation extends Model {

    public $table = 'rkp_pay_types_translations';

    public $timestamps = false;

    public $fillable = ['name'];

    public static $rules = ['name' => 'required|string|min:1'];
}
