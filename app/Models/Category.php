<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'product_categories';
    public $translationModel = 'App\Models\CategoryTranslation';

    public $translatedAttributes = [
        'title',
        'slug',
    ];

    public $timestamps = false;

    protected $fillable = ['image'];

    public static $rules = [
        'ru.title' => 'required|string|min:3|max:255',
        'uz.title' => 'required|string|min:3|max:255',
        'en.title' => 'required|string|min:3|max:255',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->deleteTranslations();
        });
    }

    public function categoryChilds(){
        return $this->hasMany('App\Models\ChildCategory', 'category_id', 'id');
    }

}
