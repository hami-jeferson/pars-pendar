<?php
namespace App\Contracts;

use App\Models\User;

interface AuthRepositoryInterface{

    public function selfForgetCurrentAccessToken(User $user): bool;
    public function selfForgetAllTokens(User $user): bool;
    public function createToken(User $user, string $name = 'api_auth'): string;
}