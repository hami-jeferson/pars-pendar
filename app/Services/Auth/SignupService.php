<?php
namespace App\Services\Auth;

use App\Contracts\AuthRepositoryInterface;
use App\DTOs\UserDTO;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Contracts\UserRepositoryInterface;
class SignupService{
    private $userRepository;
    private $authRepository;
    public function __construct(UserRepositoryInterface $useRepository, AuthRepositoryInterface $authRepository)
    {
        $this->userRepository = $useRepository;
        $this->authRepository = $authRepository;
    }
    public function SignupUser(Request $request): Array
    {
        $userDto = new UserDTO(name: $request->get('name'),
                               email: $request->get('email'),
                               password: $request->get('password'),
                               validateUnique: true);


        $user = $this->userRepository->create($userDto);
        $token = $this->authRepository->createToken($user);

        return ['user'=>new UserResource($user), 'token'=>$token]; 

    }
}