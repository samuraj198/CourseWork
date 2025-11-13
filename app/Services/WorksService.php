<?php

namespace App\Services;

use App\Models\File;
use App\Models\History;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Auth;
use ZipArchive;

class WorksService
{
    public function __construct(private CategoryService $categoryService)
    {}
    /**
     * Create a new class instance.
     */
    public function userWorks(int $id)
    {
        return File::where('user_id', $id)
            ->where('status', 'Одобрено')->orderBy('created_at', 'desc')->paginate(12);
    }

    public function countOfUserVerificationWorks(int $id): int
    {
        return File::where('user_id', $id)
            ->where('status', 'Проверяется')->count();
    }

    public function getForAdminPanel(string $status)
    {
        $files = File::query();
        if ($status) {
            $files->where('status', $status);
        }
        return $files->orderBy('created_at', 'desc')->paginate(12);
    }

    public function store(array $data, UploadedFile $img, UploadedFile $file): File
    {
        $data['user_id'] = Auth::id();

        if ($img) {
            $imgName = $this->createNameForImage($img);
            $img->storeAs('files_previews', $imgName, 'public');
        }
        $fileName = $this->createNameForFile($file);
        $file->storeAs('files', $fileName, 'public');
        $work = File::create([
            'img' => $imgName,
            'name' => $data['name'],
            'information' => $data['information'],
            'category_id' => $data['category_id'],
            'user_id' => $data['user_id'],
            'file' => $fileName,
        ]);
        $this->categoryService->updateCount($work->category_id, 'plus');
        return $work;
    }

    public function update(array $data, ?UploadedFile $img, ?UploadedFile $file): File
    {
        $work = File::findOrFail($data['work_id']);

        $work->name = $data['name'];
        $work->information = $data['information'];
        $work->category_id = $data['category_id'];
        $work->status = 'Проверяется';

        if ($img) {
            Storage::disk('public')->delete('files_previews/' . $work->img);
            $imgName = $this->createNameForImage($img);
            $work->img = $imgName;
            $img->storeAs('files_previews', $imgName, 'public');
        }
        if ($file) {
            Storage::disk('public')->delete('files/' . $work->file);
            $fileName = $this->createNameForFile($file);
            $work->file = $fileName;
            $file->storeAs('files', $fileName, 'public');
        }
        $work->save();

        return $work;
    }

    public function destroy($id)
    {
        $work = File::findOrFail($id);

        if ($work->img) {
            Storage::disk('public')->delete('files_previews/' . $work->img);
        }
        if ($work->file) {
            Storage::disk('public')->delete('files/' . $work->file);
        }
        Storage::disk('public')->delete('extracted/' . $work->id);
        $this->categoryService->updateCount($work->category_id, 'minus');

        return  $work->delete();
    }

    public function changeStatus(int $id, string $status): File
    {
        $file = File::findOrFail($id);

        if ($file->status !== 'Одобрено' && $status == 'Одобрено') {
            $this->categoryService->updateCount($file->category_id, 'plus');
        } elseif ($file->status == 'Одобрено' && $status == 'Отклонено') {
            $this->categoryService->updateCount($file->category_id, 'minus');
        }

        $file->update([
            'status' => $status,
            'updated_at' => now(),
        ]);

        return $file;
    }

    public function downloadFile($id)
    {
        try {
            $fileRecord = File::findOrFail($id);
            $filePath = storage_path('app/public/files/' . $fileRecord->file);

            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'Файл не найден');
            }

            if (!auth()->check()) {
                return redirect()->back()->with('error', 'Перед скачиванием необходимо зайти в аккаунт');
            }

            $existingHistory = History::where('user_id', auth()->user()->id)
                ->where('file_id', $id)
                ->first();

            if (!$existingHistory) {
                History::create([
                    'user_id' => auth()->user()->id,
                    'file_id' => $id,
                ]);
            }

            $fileRecord->increment('downloadCount');

            return response()->download($filePath, $fileRecord->file);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Файл не найден');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка при скачивании');
        }
    }

    public function show($id)
    {
        $file = File::findOrFail($id);
        $error = null;
        $modelPath = null;

        $filePath = storage_path('app/public/files/' . $file->file);
        $extractPath = storage_path('app/public/extracted/' . $file->id);

        // Создаем директорию для извлечения, если ее нет
        if (!file_exists($extractPath)) {
            mkdir($extractPath, 0755, true);
        }

        // Открываем и извлекаем ZIP-архив
        $zip = new ZipArchive;
        if ($zip->open($filePath) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();

            // Ищем 3D-модель в извлеченных файлах
            $modelPath = $this->findModelFile($extractPath, $file->id);

            if (!$modelPath) {
                $error = '3D-модель не найдена в архиве';
            }
        } else {
            $error = 'Не удалось загрузить предпросмотр.
            Возможно, загружен не zip-архив или в архиве нет поддерживаемого формата файла.';
        }

        return [
            'file' => $file,
            'modelPath' => $modelPath,
            'error' => $error
        ];
    }

    private function findModelFile($extractPath, $fileId)
    {
        foreach (scandir($extractPath) as $fileItem) {
            if ($fileItem === '.' || $fileItem === '..') continue;

            if (preg_match('/\.(glb|gltf)$/i', $fileItem)) {
                return asset('storage/extracted/' . $fileId . '/' . $fileItem);
            }
        }
        return null;
    }

    private function createNameForImage(UploadedFile $img): string
    {
        $name = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
        return 'preview_' . $name . '_' . Auth::user()->login . '_' .
            now()->format('YmdHis') . '.' . $img->getClientOriginalExtension();
    }

    private function createNameForFile(UploadedFile $file): string
    {
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        return 'file_' . $name . '_' . Auth::user()->login . '_' .
            now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
    }
}
