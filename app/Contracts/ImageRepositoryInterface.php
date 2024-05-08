<?php
namespace App\Contracts;

use App\DTOs\ImageDTO;
use App\Models\UploadImages;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

interface ImageRepositoryInterface{
    public function upload(Request $request): UploadImages|null;

    public function delete(UploadImages|null $images): void;
}