<?php
namespace App\DTOs;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FeedbackDTO{
    private $action;
    private $userId;
    public function __construct(string $action = null, int $userId)
    {
        $this->validate($action);
        $this->action = $action;
        $this->userId = $userId;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    protected function validate($action)
    {
        $validator = Validator::make([
            'action' => $action
        ], [
            'action' => ['required', Rule::in(['like', 'dislike'])]
        ]);

        if ($validator->fails()) {
//            throw ValidationException::withMessages($validator->errors()->toArray());
            throw new ValidationException($validator, new JsonResponse(['success' => false, 'message' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
