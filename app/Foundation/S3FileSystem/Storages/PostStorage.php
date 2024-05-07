<?php

namespace App\Foundation\S3FileSystem\Storages;


use App\Foundation\S3FileSystem\PublicS3Uploader;

class PostStorage extends PublicS3Uploader
{
    public function __construct()
    {
        $this->destinationPath = 'post';
    }
}
