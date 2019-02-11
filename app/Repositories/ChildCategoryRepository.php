<?php

namespace App\Repositories;

use App\Models\ChildCategory;
use InfyOm\Generator\Common\BaseRepository;

class ChildCategoryRepository extends BaseRepository
{
    public function model() { return ChildCategory::class; }
}