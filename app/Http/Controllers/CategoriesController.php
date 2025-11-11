<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function __construct(private CategoryService $service)
    {}

    public function changeCategory(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'nullable|string',
            'action' => 'required|in:change,delete'
        ]);

        $category = Category::findOrFail($data['category_id']);

        if ($data['action'] === 'delete') {
            $category->delete();
            Storage::disk('public')->delete('categories/' . $category->img);
            return redirect()->back()->with('successDelCat', 'Вы успешно удалили категорию');
        } else {
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $name = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
                $imgName = $name . '_' . now()->format('YmdHis') . '.' . $img->getClientOriginalExtension();

                if ($category->img && Storage::disk('public')->exists('categories/' . $category->img)) {
                    Storage::disk('public')->delete('categories/' . $category->img);
                }

                $img->storeAs('categories', $imgName, 'public');
                $category->img = $imgName;
                $category->save();
            }
            if (isset($data['name'])) {
                $category->name = $data['name'];
                $category->save();
            }
            return redirect()->back()->with('successChangeCat', 'Вы успешно изменили категорию');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $img = $request->file('img');
        $name = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
        $imgName = $name . '_' . now()->format('YmdHis') . '.' . $img->getClientOriginalExtension();
        $img->storeAs('categories', $imgName, 'public');
        $data['img'] = $imgName;

        $category = $this->service->store($data);

        return back()->with('success', 'Категория успешно создана');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
