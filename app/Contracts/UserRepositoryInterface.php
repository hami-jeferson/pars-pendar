<?php
namespace App\Contracts;

use App\DTOs\UserDTO;
use App\Models\User;

interface UserRepositoryInterface{
    public function create(UserDTO $data): User;

    public function findByEmail(string $email): User|null;

    public function passwordMatch(User $user, string $password): bool;

    public function adminUser(): User;
}