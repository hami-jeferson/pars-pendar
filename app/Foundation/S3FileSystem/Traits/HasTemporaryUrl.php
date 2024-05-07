<?php

namespace App\Foundation\S3FileSystem\Traits;

use Illuminate\Support\Facades\Storage;

trait HasTemporaryUrl
{
    /**
     * Return signed path to file
     */
    public function temporaryUrl(string $relativePath): string
    {
        return Storage::disk($this->disk)
            ->temporaryUrl(
                path: $relativePath,
                expiration: $this->expiration()
            );
    }
}
