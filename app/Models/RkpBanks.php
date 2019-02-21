<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RkpBanks extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'rkp_accounts';

    public $translationModel = 'App\Models\RkpBanksTranslation';

    public $translatedAttributes = [
        'bank_name',
    ];

    public $timestamps = false;

    protected $fillable = ['code_name', 'bank_code', 'account', 'monet_id', 'is_active', 'saldo'];

    public static $rules = [
        'ru.bank_name' => 'required|string|min:1|max:255',
        'uz.bank_name' => 'required|string|min:1|max:255',
        'en.bank_name' => 'required|string|min:1|max:255',
        'bank_code' => 'required',
        'account' => 'required',
        'monet_id' => 'required',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->deleteTranslations();
        });
    }
}