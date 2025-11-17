<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FileSyncShare;

class FileSync extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shares() {
        return $this->hasMany(FileSyncShare::class, 'file_id');
    }
}
