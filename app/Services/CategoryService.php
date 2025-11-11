<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

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

    public function update($data, $newImgName)
    {
        $category = Category::findOrFail($data['category_id']);

        if ($category->img && Storage::disk('public')->exists('categories/' . $category->img)) {
            Storage::disk('public')->delete('categories/' . $category->img);
        }

        if (isset($newImgName)) {
            $category->img = $newImgName;
        }
        if (isset($data['name'])) {
            $category->name = $data['name'];
        }
        $category->save();

        return $category;
    }
}
