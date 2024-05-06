<?php
namespace App\Repositories;

use App\Contracts\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface{

    public function selfForgetCurrentAccessToken(User $user): bool
    {
        return $user->currentAccessToken()->delete();
    }
    public function selfForgetAllTokens(User $user): bool
    {
        return $user->tokens()->delete();
    }
    public function createToken(User $user, string $tokenName = 'api_auth'): string
    {
        $this->selfForgetAllTokens($user);
        return $user->createToken($tokenName)->plainTextToken;
    }
}