<?php

namespace App\Foundation\S3FileSystem\Traits;


use Illuminate\Support\Facades\Storage;

trait HasTemporaryUploadUrl
{
    /**
     * Return pre-signed url for upload from client-side
     *
     * returned options array structure looks like this
     *   [
     *     'url' => $url
     *     'headers' => $headers
     *   ]
     *
     */
    public function temporaryUploadUrl(
        string $fileName,
    ): array
    {
        return Storage::disk($this->disk)
           ->temporaryUploadUrl(
            path: $this->makePath($fileName),
            expiration: $this->expiration()
        );
    }
}
