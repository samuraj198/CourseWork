<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function downloadFile($id)
    {
        $fileRecord = File::findOrFail($id);
        $filePath = storage_path('app/public/files/'.$fileRecord->file);

        if (!file_exists($filePath)) {
            return response()->json(['message' => 'Файл не найден'], Response::HTTP_NOT_FOUND);
        } else {
            $file = History::where('user_id', \auth()->user()->id)->where('file_id', $id);
        }

        if (auth()->check()) {
            if (!empty($file)) {
                $history = History::firstOrCreate([
                    'user_id' => auth()->user()->id,
                    'file_id' => $id,
                ]);
            }
            return response()->download($filePath, $fileRecord->file);
        } else {
            return back()->withErrors('Перед скачиванием необходимо зайти в аккаунт');
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
    public function store(Request $request)
    {
        $user = Auth::user();
        $oldFile = File::find($request->input('changeId'));

        $rules = [
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'information' => 'required|string|max:300',
            'file' => 'nullable|file|mimes:zip,rar,7z,tar,gz|max:51200',
        ];

        if (empty($oldFile)){
            $rules['file'] = 'required|file|mimes:zip,rar,7z,tar,gz|max:51200';
        }
        $request->validate($rules);

        if ($oldFile) {
            $oldFile->name = $request->input('name');
            $oldFile->information = $request->input('information');
            $oldFile->category_id = $request->input('category_id');

            if ($request->hasFile('img')) {
                Storage::disk('public')->delete('files_previews/'.$oldFile->img);
                if($request->hasFile('img')){
                    $img = $request->file('img');
                    $imgName = 'preview_' . $request['name'] . '_' . $user->login . '_' . now()->format('YmdHis') . '.' . $img->getClientOriginalExtension();
                    $oldFile->img = $imgName;
                    $img->storeAs('files_previews', $imgName, 'public');
                }
            }
            $oldFile->save();
            return back()->with('success', 'Вы успешно изменили файл');
        } else {
            $imgName = null;

            if($request->hasFile('img')){
                $img = $request->file('img');
                $imgName = 'preview_' . $request['name'] . '_' . $user->login . '_' . now()->format('YmdHis') . '.' . $img->getClientOriginalExtension();
                $img->storeAs('files_previews', $imgName, 'public');
            }

            $file = $request->file('file');
            $fileOrigName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = 'file_' . $fileOrigName . '_' . $user->login . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('files', $fileName, 'public');

            $work = File::create([
                'img' => $imgName,
                'name' => $request['name'],
                'information' => $request['information'],
                'category_id' => $request['category_id'],
                'user_id' => $user->id,
                'file' => $fileName,
            ]);

            return back()->with('success', 'Файл успешно опубликован');
        }
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
    public function destroy(Request $request)
    {
        $work = File::findOrFail($request->input('id'));

        if ($work->img) {
            Storage::disk('public')->delete('files_previews/'.$work->img);
        }
        if ($work->file) {
            Storage::disk('public')->delete('files/'.$work->file);
        }
        $work->delete();
        return back()->with('success', 'Файл успешно удален');
    }
}
