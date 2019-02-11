<?php

namespace App\Models;

use Eloquent as Model;

class RkpBanksTranslation extends Model {

    public $table = 'rkp_account_translations';

    public $timestamps = false;

    public $fillable = ['bank_name'];

    public static $rules = ['bank_name' => 'required|string|min:1'];
}
