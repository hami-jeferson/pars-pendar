<?php

namespace App\Foundation\S3FileSystem\Traits;

trait HasExpiration
{
    /**
     * retrieve expiration
     */
    protected function expiration()
    {
        return now()->addMinutes(config($this->lifeTimePathInConfig));
    }
}
