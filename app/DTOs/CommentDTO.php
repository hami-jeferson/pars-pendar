<?php
namespace App\DTOs;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CommentDTO{
    private $rate;
    private $comment;
    public function __construct(int $rate, string $comment = null)
    {
        $this->validate($rate);
        $this->rate = $rate;
        $this->comment = $comment;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getComment()
    {
        return $this->comment;
    }

    protected function validate($rate)
    {
        $validator = Validator::make([
            'rate' => $rate
        ], [
            'rate' => 'required|integer|min:1|max:5'
        ]);

        if ($validator->fails()) {
//            throw ValidationException::withMessages($validator->errors()->toArray());
            throw new ValidationException($validator, new JsonResponse(['success'=>false, 'message'=>$validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
}
