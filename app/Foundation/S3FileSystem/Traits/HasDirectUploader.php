<?php

namespace App\Foundation\S3FileSystem\Traits;

use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasDirectUploader
{
    /**
     * Upload to the file storage
     *
     * @param File|UploadedFile|string $file
     * @param string|null $fileName
     * @return false|string
     */
    public function uploadAs(
        File|UploadedFile|string $file,
        string $fileName = null
    ): false|string
    {

        return Storage::disk($this->disk)
        ->putFileAs(
            path: $this->directPath(),
            file: $file,
            name: $this->fileNamer($fileName),
            options: $this->visibility
        );
    }

    private function fileNamer($name = null): string
    {
        return Carbon::now()->year     . '_' .
            Carbon::now()->month       . '_' .
            Carbon::now()->day         . '_' .
            Carbon::now()->hour        . '_' .
            Carbon::now()->minute      . '_' .
            Carbon::now()->second      . '_' .
            Carbon::now()->microsecond . '_' .
            $name;
    }
}
