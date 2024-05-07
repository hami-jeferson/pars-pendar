<?php

namespace App\Foundation\S3FileSystem;

abstract class PublicS3Uploader extends S3Uploader
{
    protected string $path = '';
    protected string $disk = 'public_r1';
    protected string $visibility = 'public';
    protected string $lifeTimePathInConfig = 'filesystems.disks.public_r1.signed_url_lifetime';

    /**
     * It has to be overwritten in concrete implementation
     * to address the destinationPath
     */
    abstract function __construct();
}
