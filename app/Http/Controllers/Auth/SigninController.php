<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\SigninService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\Response;
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
