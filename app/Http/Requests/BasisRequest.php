<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Basis;

class BasisRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Basis::$rules;}
}
