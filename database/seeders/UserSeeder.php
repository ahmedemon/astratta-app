<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'     => 'Ahmed Emon',
                'username'      => 'ahmedemon',
                'email'          => 'ahmedemon@gmail.com',
                'email_verified_at' => now(),
                'password'       => bcrypt('ahmedemon'), // password
                'remember_token' => null,
                'privacy_policy' => 1,
                'is_active' => 0,
                'is_approve' => 0,
                'is_blocked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'     => 'Ejaz Ahmed',
                'username'      => 'ejazahmed',
                'email'          => 'ejazahmed@gmail.com',
                'email_verified_at' => now(),
                'password'       => bcrypt('ahmedemon'), // password
                'remember_token' => null,
                'privacy_policy' => 1,
                'is_active' => 0,
                'is_approve' => 0,
                'is_blocked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
