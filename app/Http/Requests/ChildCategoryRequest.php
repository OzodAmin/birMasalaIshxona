<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ChildCategory;

class ChildCategoryRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return ChildCategory::$rules;}
}