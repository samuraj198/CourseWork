<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function store($data)
    {
        $category = Category::create($data);

        return $category;
    }
}
