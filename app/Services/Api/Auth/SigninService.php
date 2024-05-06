<?php
namespace App\Services\Api\Auth;

use App\Contracts\AuthRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\DTOs\UserDTO;
use App\Http\Resources\UserResource;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SigninService{
    use Response;
    private $userRepository;
    private $authRepository;
    public function __construct(UserRepositoryInterface $useRepository, AuthRepositoryInterface $authRepository)
    {
        $this->userRepository = $useRepository;
        $this->authRepository = $authRepository;
    }
    public function SigninUser(Request $request): JsonResponse
    {
        $userDto = new UserDTO(email: $request->get('email'),
                               password: $request->get('password'));

        // find user by email
        $user = $this->userRepository->findByEmail($userDto->getEmail());
        if($user) {
            if ($this->userRepository->passwordMatch(user: $user, password: $userDto->getPassword())) { // match password
                $token = $this->authRepository->createToken($user);
                $res = $this->success(data: ['user' => new UserResource($user), 'token' => $token]);
            } else { // password does not match
                $res = $this->error(msg: 'password does not match');
            }
        }else{ // user not found
            $res = $this->error(msg: 'User not found');
        }

        return $res;

    }
}