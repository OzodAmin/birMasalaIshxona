<?php

namespace App\Repositories;

use App\Models\Currency;
use InfyOm\Generator\Common\BaseRepository;

class CurrencyRepository extends BaseRepository
{
    protected $fieldSearchable = ['code'];
    public function model(){return Currency::class;}
}
