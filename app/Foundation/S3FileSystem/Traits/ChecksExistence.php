<?php

namespace App\Foundation\S3FileSystem\Traits;

use Illuminate\Support\Facades\Storage;

trait ChecksExistence
{
    /**
     * checks weather the file exists on the disk
     */
    public function exists(string $path): bool
    {
        return Storage::disk($this->disk)->exists($path);
    }
}
