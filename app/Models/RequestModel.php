<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use App\Models\Product;

class RequestModel extends Model
{
	public $table = 'request';

	protected $casts = [
        'owner_product_id' => 'integer', 
        'owner_id' => 'integer',
        'user_id' => 'integer',
        'user_product_id' => 'integer'
    ];

	protected $fillable = [
        'owner_product_id', 
        'owner_id',
        'user_id',
        'user_product_id',
        'user_product_price',
        'status',
        'expire_at'
    ];

    public static $rules = [
        'user_product_price' => 'required',
        'user_product_id' => 'required'
    ];

    public function userOwner(){return $this->belongsTo(User::class, 'owner_id', 'id');}
    public function userOwnerProduct(){return $this->belongsTo(Product::class, 'owner_product_id', 'id');}
    public function userRequest(){return $this->belongsTo(User::class, 'user_id', 'id');}
    public function userRequestProduct(){return $this->belongsTo(Product::class, 'user_product_id', 'id');}
}