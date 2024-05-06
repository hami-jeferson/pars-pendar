<?php
namespace App\DTOs;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostDTO{
    private $title;
    private $content;
    public function __construct(string $title = null, string $content = null)
    {
        $this->validate($title, $content);
        $this->title = $title;
        $this->content = $content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    protected function validate($title, $content)
    {
        $validator = Validator::make([
            'title' => $title,
            'content' => $content
        ], [
            'title'=> 'required|string',
            'content'=> 'required|string'
        ]);

        if ($validator->fails()) {
//            throw ValidationException::withMessages($validator->errors()->toArray());
            throw new ValidationException($validator, new JsonResponse(['success'=>false, 'message'=>$validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
