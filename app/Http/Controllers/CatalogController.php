<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Проверка, есть ли параметр filename в запросе
        $filename = $request->input('filename', '');
        $categ = $request->input('categ', '');

        $files = File::when(!empty($filename) || !empty($categ), function ($query) use ($filename, $categ) {
            if (!empty($filename)) {
                $query->where('name', 'like', "%{$filename}%")->paginate(18);
            }
            if (!empty($categ)) {
                $query->where('category_id', $categ)->paginate(18);
            }
        })->get();

        if (!empty($categ)) {
            $categ_name = Category::where('id', $categ)->value('name');
        } else {
            $categ_name = '';
        }
        // Все категории и работы для общего каталога
        $categories = Category::all();

        return view('pages/catalog', compact('categories', 'files', 'filename', 'categ', 'categ_name'));
    }

    public function searchClear(Request $request)
    {
        $filename = $request->input('filename', '');
        $categ = $request->input('categ', '');

        if ($request->has('clear_categ')) {
            $categ = '';
        }
        if ($request->has('clear_filename')) {
            $filename = '';
        }
        if ($request->has('clear_all')) {
            $filename = '';
            $categ = '';
        }

        return redirect()->route('catalog', [
            'categ' => $categ,
            'filename' => $filename,
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
