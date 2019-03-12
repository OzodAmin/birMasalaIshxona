<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Models\City;
use App\Models\District;
use App\Role;
use App\Models\UserStatus;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable;
    use HasApiTokens;
    use EntrustUserTrait;

    protected $fillable = ['role','name', 'inn', 'email', 'company_legal_name', 'phone', 'address', 'status', 'password', 'username', 'email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules =[
            'name' => 'required|max:255',
            'inn' => 'integer|required|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'company_legal_name' => 'required', 
            'phone' => 'required', 
            'address' => 'required'
    ];

    public function statuses(){return $this->belongsTo(UserStatus::class, 'status', 'id');}
    public function role(){return $this->belongsTo(Role::class);}
}
