<?php

namespace App\Services;

use App\Models\History;

class HistoryService
{
    /**
     * Create a new class instance.
     */
    public function getByUserId($id)
    {
        return History::where('user_id', $id)
            ->orderBy('created_at', 'desc')->paginate(12);
    }
}
