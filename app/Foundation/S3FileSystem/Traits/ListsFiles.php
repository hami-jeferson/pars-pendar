<?php

namespace App\Foundation\S3FileSystem\Traits;

use Illuminate\Support\Facades\Storage;

trait ListsFiles
{
    /**
     * Retrieve all files of directory (recursively)
     */
    public function allFiles(string $subDirectory = ''): array
    {
        $path = $subDirectory !== ''
            ? $this->destinationPath . '/' . $subDirectory
            : $this->destinationPath;

        return Storage::disk($this->disk)
            ->allFiles($path);
    }

    /**
     * Retrieve all files of directory
     */
    public function files(string $subDirectory = ''): array
    {
        $path = $subDirectory !== ''
            ? $this->destinationPath . '/' . $subDirectory
            : $this->destinationPath;

        return Storage::disk($this->disk)
            ->files($path);
    }
}
