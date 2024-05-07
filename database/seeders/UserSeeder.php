<?php

namespace Database\Seeders;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # create admin user
        $userRepository = new UserRepository();
        $userDTO = new UserDTO(name: 'Hami Jeferson', email:'admin@gmail.com' , password:12345678 , type: 'admin');
        $userRepository->create($userDTO);

        # create author user
        $userRepository = new UserRepository();
        $userDTO = new UserDTO(name: 'Hami Jeferson', email:'hami.sparow@gmail.com' , password:12345678 , type: 'author');
        $userRepository->create($userDTO);

        # create sample users
        for ($i = 0; $i < 5; $i++) {
            $userDTO = new UserDTO(name: fake()->name(),
                                   email:fake()->email(),
                                   password: '12345678');
            $userRepository->create($userDTO);
        }
    }
}
