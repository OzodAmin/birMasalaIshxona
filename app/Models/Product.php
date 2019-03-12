<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use App\Models\Basis;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Measure;
use App\Models\ProductStatus;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'product';
    public $translationModel = 'App\Models\ProductTranslation';
    public $translatedAttributes = ['title', 'description', 'conditions', 'slug'];
    protected $casts = [
        'user_id' => 'integer', 
        'parent_category_id' => 'integer', 
        'child_category_id' => 'integer', 
        'manufacturer_country_id' => 'integer', 
        'measure_id' => 'integer', 
        'status' => 'integer', 
        'basis_id' => 'integer', 
        'currency_id' => 'integer'
    ];
    protected $fillable = [
        'user_id', 
        'tnved', 
        'deposit', 
        'parent_category_id', 
        'child_category_id', 
        'manufacturer_country_id', 
        'manufacturer_title', 
        'warranty', 
        'measure_id', 
        'quantity', 
        'min_order', 
        'max_order', 
        'price', 
        'currency_id', 
        'nds', 
        'produced_year', 
        'usage_percentage', 
        'usage_period', 
        'usage_condition', 
        'status', 
        'basis_day',
        'basis_transport_type',
        'basis_id',
        'lot_number',
        'expire_at'
    ];

    public static $rules = [
        'manufacturer_title' => 'required|string|min:1|max:255',
        'tnved' => 'required',
        'parent_category_id' => 'required',
        'child_category_id' => 'required',
        'manufacturer_country_id' => 'required',
        'srok_godnosti' => 'required|date|after:today',
        'warranty' => 'required',
        'measure_id' => 'required',
        'quantity' => 'required',
        'min_order' => 'required',
        'max_order' => 'required',
        'currency_id' => 'required',
        'price' => 'required',
        'produced_year' => 'required',
        'basis_id' => 'required',
        'basis_day' => 'required',
        'basis_transport_type' => 'required',        
        'usage_percentage' => 'min:0|max:100',
        'nds' => 'min:0|max:100',
    ];

    protected static function boot() {
        parent::boot();

        static::creating( function($product) {
            $product->lot_number = $product->user_id.'-'.time();
        });

        static::deleting(function($product) {
            $product->deleteTranslations();
        });
    }

    public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}
    public function basis(){return $this->belongsTo(Basis::class, 'basis_id', 'id');}
    public function categoryMain(){return $this->belongsTo(Category::class, 'parent_category_id', 'id');}
    public function categoryChild(){return $this->belongsTo(ChildCategory::class, 'child_category_id', 'id');}
    public function currency(){return $this->belongsTo(Currency::class, 'currency_id', 'id');}
    public function measureTable(){return $this->belongsTo(Measure::class, 'measure_id', 'id');}
    public function statusTable(){return $this->belongsTo(ProductStatus::class, 'status', 'id');}
    public function country(){return $this->belongsTo(Country::class, 'manufacturer_country_id', 'id');}
}