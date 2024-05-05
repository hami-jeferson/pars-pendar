<?php
namespace App\Contracts;

use App\Models\User;

interface AuthRepositoryInterface{
    public function createToken(User $user, string $name = 'api_auth'): string;
}