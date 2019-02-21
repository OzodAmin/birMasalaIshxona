<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\RkpPayTypes;
use App\Models\RkpBanks;
use App\Models\Currency;
use App\Models\Rkp;
use App\User;

class RkpPayment extends Model
{
    public $table = 'rkp_payment';

    protected $casts = [
        'user_id' => 'integer',
        'rkpPayType' => 'integer',
        'sendClient_ID' => 'integer',
        'sendRkpAccount_ID' => 'integer',
        'recieveClient_ID' => 'integer',
        'recieveRkpAccount_ID' => 'integer',
        'IsActive' => 'integer',
        'Status' => 'integer',
        'rkp_accounts_id' => 'integer',
        'currency_id' => 'integer'
    ];

    protected $fillable = ['date', 'docNomer', 'rkpPayType', 'reason', 'sendClient_ID', 'sendRkpAccount_ID', 'recieveClient_ID', 'recieveRkpAccount_ID', 'summa', 'user_id', 'Status', 'IsActive', 'currency_id', 'rkp_accounts_id'];

    public static $rules = [
        'date' => 'required',
        'docNomer' => 'required',
        'rkpPayType' => 'required',
        'reason' => 'required',
        'summa' => 'required|regex:/^\d*(\.\d{1,2})?$/',
    ];

    public function account(){return $this->belongsTo(RkpBanks::class, 'rkp_accounts_id', 'id');}
    public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}
    public function payType(){return $this->belongsTo(RkpPayTypes::class, 'rkpPayType', 'id');}
    public function userSend(){return $this->belongsTo(User::class, 'sendClient_ID', 'id');}
    public function userSendAccount(){return $this->belongsTo(Rkp::class, 'sendRkpAccount_ID', 'id');}
    public function userReceive(){return $this->belongsTo(User::class, 'recieveClient_ID', 'id');}
    public function operator(){return $this->belongsTo(User::class, 'user_id', 'id');}
}