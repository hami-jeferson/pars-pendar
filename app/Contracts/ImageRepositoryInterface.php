<?php
namespace App\Contracts;

use App\DTOs\ImageDTO;
use App\Models\UploadImages;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

interface ImageRepositoryInterface{
    public function upload(File|UploadedFile $file, ImageDTO $data): UploadImages;

    public function delete(UploadImages|null $images): void;
}