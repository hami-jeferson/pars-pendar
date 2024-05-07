<?php
namespace App\DTOs;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File as FileRule;
use Illuminate\Validation\ValidationException;

class ImageDTO{
    const file_size = 1024 * 2;
    private $name;
    private $url;
    private $path;
    private $size;
    private $extension;
    public function __construct(string $name = null, string $size = null, string $extension = null)
    {
        $this->validate($size, $extension);
        $this->name = $name;
        //$this->url = $url;
        //$this->path = $path;
        $this->size = $size;
        $this->extension = $extension;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setUrl(string $val)
    {
        $this->url = $val;
    }

    public function setPath(string $val)
    {
        $this->path = $val;
    }

    protected function validate($size, $extension)
    {
        $validator = Validator::make([
            'size' => $size,
            'extension' => $extension
        ], [
            'size'=> ['required', 'max:'.self::file_size],
            'extension'=> ['required', Rule::in(['jpg','jpeg','png'])]
        ]);

        if ($validator->fails()) {
//            throw ValidationException::withMessages($validator->errors()->toArray());
            throw new ValidationException($validator, new JsonResponse(['success'=>false, 'message'=>$validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
