<?php
namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {
    public function create(UserDTO $data): User
    {
        return User::Create(['name'=>$data->getName(),
                             'email'=>$data->getEmail(),
                             'password'=>$data->getPassword(),
                             'type'=>$data->getType()]);
    }

    public function findByEmail(string $email): User|null
    {
        return User::Email($email)->first();
    }

    public function passwordMatch(User $user, string $password): bool
    {
        return Hash::check($password, $user->getAuthPassword());
    }

    public function adminUser(): User
    {
        return User::Admin()->first();
    }
}
