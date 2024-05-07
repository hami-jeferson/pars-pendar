<?php

namespace App\Foundation\S3FileSystem\Traits;

trait HasPath
{
    /**
     * returns path of the file before writing
     */
    public function makePath(string $fileName): string
    {
        if ($this->path === '') {
            $this->path = $this->destinationPath .
                '/' .
                fileNamer($fileName);
        }

        return $this->path;
    }

    /**
     * returns the already set path
     */
    public function path(): string
    {
        return $this->path;
    }
}
