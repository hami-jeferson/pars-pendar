<?php

namespace App\Foundation\S3FileSystem\Traits;

use Illuminate\Support\Facades\Storage;

trait HasFileSize
{
    /**
     * retrieve file size in format of human-readable
     */
    public function size(string $relativePath): int
    {
        return Storage::disk($this->disk)
            ->size($relativePath);
    }
}
