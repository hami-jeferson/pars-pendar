<?php
namespace App\Repositories;

use App\Contracts\ImageRepositoryInterface;
use App\DTOs\ImageDTO;
use App\Foundation\S3FileSystem\Storages\PostStorage;
use App\Models\UploadImages;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageRepository implements ImageRepositoryInterface{
    private $storage;

    public function __construct(PostStorage $storage)
    {
        $this->storage = $storage;
    }
    public function upload(Request $request): UploadImages|null
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageDTO = new ImageDTO(name:$file->getClientOriginalName() , size:$file->getSize() , extension: $file->getClientOriginalExtension());

            $fileRelativePath = $this->storage->uploadAs($file, $imageDTO->getName());
            if (!$fileRelativePath) {
                throw response()->json(['success'=>false, 'message'=>'Error in upload file']);
            }
            $imageDTO->setPath($fileRelativePath);
            $imageDTO->setUrl(env('SITE_PUBLIC_ENDPOINT').'/'.$fileRelativePath);

            return UploadImages::create(['file_name'=>$imageDTO->getName(),
                                         'url'=>$imageDTO->getUrl(),
                                         'relative_url'=>$imageDTO->getPath(),
                                         'size_in_bytes'=>$imageDTO->getSize(),
                                         'extension'=>$imageDTO->getExtension()]);

        }
        return null;
    }

    public function delete(UploadImages|null $images): void
    {
        if(!empty($images)) {
            $this->storage->delete($images->relative_url);
            $images->delete();
        }
    }
}