<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class EloquentCategoryRepository implements CategoryRepository
{
    public function list(): Collection
    {
        return Category::query()->select(['id', 'name'])->get();
    }
}
