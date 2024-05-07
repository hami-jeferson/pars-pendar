<?php

namespace App\Foundation\S3FileSystem\Traits;

use Illuminate\Support\Facades\Storage;

trait HasDeleteFile
{
    /**
     * Delete specified file from storage
     */
    public function delete(string $relativePath): bool
    {
        return Storage::disk($this->disk)
            ->delete($relativePath);
    }
}
