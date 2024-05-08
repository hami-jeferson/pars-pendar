<?php

namespace Tests\Feature;

use App\DTOs\ImageDTO;
use App\Foundation\S3FileSystem\Storages\PostStorage;
use App\Models\PostModel;
use App\Models\UploadImages;
use App\Repositories\ImageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private $imageRepository;
    private $postImage;

    public function setUp(): void
    {
        parent::setUp();
        $this->postImage = new PostStorage();
        $this->imageRepository = new ImageRepository($this->postImage);

    }

    /** @test */
    public function it_can_upload_an_image()
    {
        $filePath = public_path('test_image.jpg'); // Replace 'test_image.jpg' with the path to your test image

        $file = new UploadedFile($filePath, 'test_image.jpg', 'image/jpeg', null, true);
        $request = new Request();
        $request->files->add(['image' => $file]);

        $uploadedImage = $this->imageRepository->upload($request);

        $this->assertInstanceOf(UploadImages::class, $uploadedImage);
        $this->assertEquals('test_image.jpg', $uploadedImage->file_name);
        $this->assertStringContainsString(env('SITE_PUBLIC_ENDPOINT'), $uploadedImage->url);
    }

    /** @test */
    public function it_can_delete_an_image()
    {
        $filePath = public_path('test_image.jpg'); // Replace 'test_image.jpg' with the path to your test image

        $file = new UploadedFile($filePath, 'test_image.jpg', 'image/jpeg', null, true);
        $request = new Request();
        $request->files->add(['image' => $file]);

        $uploadedImage = $this->imageRepository->upload($request);

        $this->imageRepository->delete($uploadedImage);

        $this->assertDatabaseMissing(UploadImages::class, ['id'=>$uploadedImage->id]);
    }
}
