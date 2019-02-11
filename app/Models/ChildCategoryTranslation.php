<?php

namespace App\Models;

use Eloquent as Model;

class ChildCategoryTranslation extends Model {

    public $table = 'product_category_children_translations';

    public static function boot() {

        parent::boot();

        static::creating( function($category_translation) {

            $category_translation->slug = str_slug($category_translation->title);

            $latest_slug =static::whereRaw("slug RLIKE '^{$category_translation->slug}(-[0-9]*)?$'")
                                    ->latest('id')
                                    ->value('slug');

            if( $latest_slug ) {

                $pieces = explode('-', $latest_slug);
                $number = intval(end($pieces));

                $category_translation->slug .= '-' . ($number + 1);
            }

        });
    }

    public $timestamps = false;

    public $fillable = [
        'title',
        'slug',
    ];

    public static $rules = [
        'title' => 'required|string|min:3'
    ];
}
