<?php
namespace App\Models;
use Eloquent as Model;

class Holidays extends Model
{
    public $table = 'holidays';
    public $timestamps = false;

    protected $fillable = ['holiday'];

    public static $rules = [
        'holiday' => 'required|date|date_format:Y-m-d|after:yesterday',
    ];
}