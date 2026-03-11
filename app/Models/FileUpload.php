<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileUpload extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'filename',
        'original_filename',
        'filepath',
        'mime_type',
        'file_size',
        'extension',
        'user_id',
        'description',
        'is_public',
        'download_count'
    ];
}
