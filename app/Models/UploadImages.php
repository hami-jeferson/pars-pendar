<?php

namespace App\Models;

use App\Enum\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadImages extends Model
{
    use HasFactory;
    protected $table = Table::UPLOAD_IMAGES->value;

    protected $fillable = ['file_name', 'url', 'relative_url', 'size_in_bytes', 'extension'];
}
