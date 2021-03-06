<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return User::$rules;
    }
}
