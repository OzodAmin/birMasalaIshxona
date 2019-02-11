<?php

namespace App\Models;

use Eloquent as Model;

class RkpPayment extends Model
{
    public $table = 'rkp_payment';

    protected $casts = [
        'user_id' => 'integer',
        'rkpPayType' => 'integer',
        'usersendClient_ID_id' => 'integer',
        'sendRkpAccount_ID' => 'integer',
        'recieveClient_ID' => 'integer',
        'recieveRkpAccount_ID' => 'integer',
        'IsActive' => 'integer',
        'Status' => 'integer'
    ];

    protected $fillable = ['date', 'docNomer', 'rkpPayType', 'reason', 'sendClient_ID', 'sendRkpAccount_ID', 'recieveClient_ID', 'recieveRkpAccount_ID', 'summa', 'user_id', 'Status', 'IsActive'];

    public static $rules = [
        'date' => 'required',
        'docNomer' => 'required',
        'rkpPayType' => 'required',
        'reason' => 'required',
        'sendClient_ID' => 'required',
        'sendRkpAccount_ID' => 'required',
        'recieveClient_ID' => 'required',
        'recieveRkpAccount_ID' => 'required',
        'summa' => 'required',
        'user_id' => 'required',
    ];
}