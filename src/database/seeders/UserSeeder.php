<?php

namespace Database\Seeders;

use App\Repositories\Contract\UserRepositoryInterface;
use App\Repositories\MySql\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var UserRepositoryInterface $userRepository */
        $userRepository = app()->make(UserRepository::class);

        $user = $userRepository->findByEmail('ali@gmail.com');
        if (!$user) {
            $userRepository->create([
                'name' => 'Ali',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
        $user = $userRepository->findByEmail('reza@gmail.com');
        if (!$user) {
            $userRepository->create([
                'name' => 'Reza',
                'email' => 'reza@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
