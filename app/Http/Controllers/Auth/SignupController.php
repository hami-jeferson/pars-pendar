<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\SignupService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\Response;
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
