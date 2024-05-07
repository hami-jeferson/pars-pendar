<?php
namespace App\Services\Api;

use App\Contracts\ImageRepositoryInterface;
use App\DTOs\ImageDTO;
use App\Models\UploadImages;
use Illuminate\Http\Request;

class ImageService{
    private $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function uploadImage(Request $request): UploadImages|null
    {
        if(!empty($request->hasFile('image'))){// upload post image
            $file = $request->file('image');
            $imageDTO = new ImageDTO(name: $file->getClientOriginalName(),size: $file->getSize(), extension: $file->getClientOriginalExtension());
            return $this->imageRepository->upload($file, $imageDTO);
        }
    }
}