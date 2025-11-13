<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function __construct(private CategoryService $service)
    {}

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->service->store($data, $request->img);

        return back()->with('success', 'Категория успешно создана');
    }

    public function update(ChangeCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->service->update($data, $request->file('img'));

        return redirect()->back()->with('success', 'Вы успешно изменили категорию');
    }

    public function destroy(Request $request)
    {
        $check = $this->service->destroy($request->category_id);

        if ($check) {
            return redirect()->back()->with('success', 'Вы успешно удалили категорию');
        }

        return redirect()->back()->with('success', 'Не удалось удалить категорию');
    }
}
