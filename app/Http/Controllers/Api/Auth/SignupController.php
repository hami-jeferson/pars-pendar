<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Api\Auth\SignupService;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    use Response;
    private $signupService;
    public function __construct(SignupService $signupService)
    {
        $this->signupService = $signupService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        return $this->success(msg: 'User signed up successfully.',
                              data: $this->signupService->SignupUser($request));

    }
}
