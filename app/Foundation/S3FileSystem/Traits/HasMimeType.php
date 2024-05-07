<?php

namespace App\Foundation\S3FileSystem\Traits;

use Illuminate\Support\Facades\Storage;

trait HasMimeType
{
    /**
     * returns path of the file before writing
     */
    public function mimeType(string $path): string
    {
        return Storage::disk($this->disk)
            ->mimeType($path);
    }
}
