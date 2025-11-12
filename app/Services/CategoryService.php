<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function update(array $data, ?UploadedFile $img = null): Category
    {
        $category = Category::findOrFail($data['category_id']);

        if ($img) {
            if ($category->img) {
                Storage::disk('public')->delete('categories/' . $category->img);
            }
            $imgName = $this->generateImageName($img);
            $img->storeAs('categories', $imgName, 'public');
            $category->img = $imgName;
        }
        if (isset($data['name'])) {
            $category->name = $data['name'];
        }
        $category->save();

        return $category;
    }

    private function generateImageName(UploadedFile $img): string
    {
        $name = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
        return $name . '_' . now()->format('YmdHis') . '.' . $img->getClientOriginalExtension();
    }

    public function destroy(int $id): bool
    {
        $category = Category::findOrFail($id);

        if ($category->img) {
            Storage::disk('public')->delete('categories/' . $category->img);
        }

        return $category->delete();
    }

    public function all()
    {
        return Category::all();
    }
}
