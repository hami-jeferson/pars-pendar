<?php

namespace App\Foundation\S3FileSystem;

use App\Foundation\S3FileSystem\Traits\ChecksExistence;
use App\Foundation\S3FileSystem\Traits\HasDeleteFile;
use App\Foundation\S3FileSystem\Traits\HasDirectPath;
use App\Foundation\S3FileSystem\Traits\HasDirectUploader;
use App\Foundation\S3FileSystem\Traits\HasExpiration;
use App\Foundation\S3FileSystem\Traits\HasFileSize;
use App\Foundation\S3FileSystem\Traits\HasMimeType;
use App\Foundation\S3FileSystem\Traits\HasPath;
use App\Foundation\S3FileSystem\Traits\HasTemporaryUploadUrl;
use App\Foundation\S3FileSystem\Traits\HasTemporaryUrl;
use App\Foundation\S3FileSystem\Traits\HasUrl;
use App\Foundation\S3FileSystem\Traits\ListsFiles;

abstract class S3Uploader
{
    use ChecksExistence,
        HasPath,
        HasDirectPath,
        HasUrl,
        HasTemporaryUploadUrl,
        HasMimeType,
        HasDeleteFile,
        HasFileSize,
        ListsFiles,
        HasDirectUploader,
        HasExpiration,
        HasTemporaryUrl;

    protected string $destinationPath;
    protected string $path = '';
    protected string $disk;
    protected string $visibility;
    protected string $lifeTimePathInConfig;

    /**
     * It has to be overwritten in concrete implementations
     * to address the destinationPath
     */
    abstract function __construct();
}
