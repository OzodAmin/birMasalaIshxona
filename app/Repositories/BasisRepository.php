<?php

namespace App\Repositories;

use App\Models\Basis;
use InfyOm\Generator\Common\BaseRepository;

class BasisRepository extends BaseRepository
{
    protected $fieldSearchable = ['code'];
    public function model(){return Basis::class;}
}
