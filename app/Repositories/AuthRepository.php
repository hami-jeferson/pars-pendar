<?php
namespace App\Repositories;

use App\Contracts\AuthRepositoryInterface;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface{
    public function createToken(User $user, string $tokenName = 'api_auth'): string
    {
        return $user->createToken($tokenName)->plainTextToken;
    }
}