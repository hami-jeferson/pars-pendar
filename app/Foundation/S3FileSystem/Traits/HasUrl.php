<?php

namespace App\Foundation\S3FileSystem\Traits;

use Illuminate\Support\Facades\Storage;

trait HasUrl
{
    /**
     * Retrieve full path to the file
     *
     * @param string $relativePath
     * @return string
     */
    public function url(string $relativePath): string
    {
        return Storage::disk($this->disk)
            ->url($relativePath);
    }
}
