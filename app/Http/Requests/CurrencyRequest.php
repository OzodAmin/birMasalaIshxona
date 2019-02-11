<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Currency;

class CurrencyRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Currency::$rules;}
}
