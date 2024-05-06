<?php
namespace App\DTOs;

use App\Enum\Table;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
class UserDTO{
    private $name;
    private $email;
    private $password;
    private $type;
    private $validateUnique;
    public function __construct(string $name = null,
                                string $email = null,
                                string $password = null,
                                string $type = 'user',
                                bool $validateUnique = false)
    {
        $this->validateUnique = $validateUnique;
        $this->validate($email, $password);
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;

    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getType()
    {
        return $this->type;
    }

    protected function validate($email, $password)
    {
        $rules = [
            'email' => 'required|email:rfc'
        ];

        if ($this->validateUnique) {
            $rules['email'] .= '|unique:users,email';
        }
        $rules['password'] = 'required|min_digits:8';

        $validator = Validator::make([
            'email' => $email,
            'password' => $password
        ], $rules);

        if ($validator->fails()) {
//            throw ValidationException::withMessages($validator->errors()->toArray());
            throw new ValidationException($validator, new JsonResponse(['success'=>false, 'message'=>$validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
