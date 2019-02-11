<?php

namespace App\Repositories;

use App\Models\Category;
use InfyOm\Generator\Common\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model() { return Category::class; }
}