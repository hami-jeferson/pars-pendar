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
        $userDTO = new UserDTO(name: 'Hami Jeferson', email:'hami.sparow@gmail.com' , password:12345678 , type: 'admin');
        $userRepository->create($userDTO);

        # create sample users
        for ($i = 0; $i < 5; $i++) {
            User::factory()->create([
                'password' => bcrypt('12345678'), // Use bcrypt to hash the password
            ]);
        }
//        $sampleUser = ['user@example.com', 'user2@example.com', 'user3@example.com'];
//        foreach($sampleUser as $user){
//            $userDTO = new UserDTO(name: fake()->name(),
//                                   email:$user ,
//                                   password:12345678);
//            $userRepository->create($userDTO);
//        }
    }
}
