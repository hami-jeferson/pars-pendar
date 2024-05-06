<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Api\Auth\SigninService;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SigninController extends Controller
{
    use Response;
    private $signinService;

    public function __construct(SigninService $signinService)
    {
        $this->signinService = $signinService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        return $this->signinService->SigninUser($request);
    }
}
