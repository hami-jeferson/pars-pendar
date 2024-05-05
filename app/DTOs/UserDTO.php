<?php
namespace App\DTOs;

class UserDTO{
    private $name;
    private $email;
    private $password;
    private $type;
    public function __construct(string $name = null, string $email, string $password, string $type = 'user')
    {
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
}
