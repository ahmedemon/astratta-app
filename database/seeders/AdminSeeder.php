<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            [
                'name'     => 'Admin',
                'username'      => 'admin',
                'email'          => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password'       => bcrypt('admin'),
                'remember_token' => null,
                'role_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
