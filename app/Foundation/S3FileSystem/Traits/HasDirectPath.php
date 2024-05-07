<?php

namespace App\Foundation\S3FileSystem\Traits;

trait HasDirectPath
{
    /**
     * make public path
     */
    public function directPath(): string
    {
        return $this->destinationPath;
    }
}
