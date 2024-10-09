<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'file_id'
    ];
    protected $table = 'downloadHistory';

    public function file() {
        return $this->belongsTo(File::class, 'file_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
