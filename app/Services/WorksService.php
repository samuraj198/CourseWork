<?php

namespace App\Services;

use App\Models\File;
use Ramsey\Uuid\Type\Integer;

class WorksService
{
    /**
     * Create a new class instance.
     */
    public function userWorks($id)
    {
        return File::where('user_id', $id)
            ->where('status', 'Одобрено')->orderBy('created_at', 'desc')->paginate(12);
    }

    public function countOfUserVerificationWorks($id): Integer
    {
        return File::where('user_id', $id)
            ->where('status', 'Проверяется')->count();
    }

    public function getForAdminPanel($status)
    {
        $files = File::query();
        if ($status) {
            $files->where('status', $status);
        }
        return $files->orderBy('created_at', 'desc')->paginate(12);
    }
}
