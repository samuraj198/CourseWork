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

        // Если передан параметр filename, то ищем файлы по нему
        if (!empty($filename)) {
            $files = File::where('name', 'like', "%{$filename}%")->get();
        } else {
            $files = File::all();
        }

        // Все категории и работы для общего каталога
        $categories = Category::all();

        return view('pages/catalog', compact('categories', 'files', 'filename'));
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
