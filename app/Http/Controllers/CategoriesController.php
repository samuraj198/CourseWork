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
    public function update(ChangeCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->service->update($data, $request->file('img'));

        return redirect()->back()->with('success', 'Вы успешно изменили категорию');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $check = $this->service->destroy($request->category_id);

        if ($check) {
            return redirect()->back()->with('success', 'Вы успешно удалили категорию');
        }

        return redirect()->back()->with('success', 'Не удалось удалить категорию');
    }
}
