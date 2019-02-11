<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use App\Models\Currency;
use App\Models\UserStatus;

class Rkp extends Model
{
	public $table = 'rkp';

	protected $casts = [
        'user_id' => 'integer', 
        'inp' => 'integer',
        'bank_code' => 'integer',
        'status_id' => 'integer',
        'rkp_account_id' => 'integer',
        'currency_id' => 'integer'
    ];

	protected $fillable = [
        'user_id', 
        'inp',
        'rkp_account_id',
        'featured_image',
        'bank_account',
        'bank_name',
        'bank_code',
        'status_id',
        'user_id',
        'currency_id',
        'notes',
        'saldo',
        'created_at',
        'updated_at'
    ];

    public static $rules = [
        'featured_image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
        'bank_name' => 'required|string|min:1|max:255',
        'bank_account' => 'required',
        'bank_code' => 'required',
        'currency_id' => 'required'
    ];

    public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}
    public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}
    public function statusTable(){return $this->belongsTo(UserStatus::class, 'status_id', 'id');}
}