<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildCategory extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'product_category_children';
    public $translationModel = 'App\Models\ChildCategoryTranslation';

    public $translatedAttributes = [
        'title',
        'slug',
    ];

    public $timestamps = false;

    protected $fillable = ['image', 'category_id'];

    public static $rules = [
        'ru.title' => 'required|string|min:3|max:255',
        'uz.title' => 'required|string|min:3|max:255',
        'en.title' => 'required|string|min:3|max:255',
        'category_id' => 'required',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->deleteTranslations();
        });
    }

    public function category() { return $this->belongsTo(Category::class, 'category_id', 'id'); }
}