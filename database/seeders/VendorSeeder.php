<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::insert([
            [
                'image'     => null,
                'name'     => null,
                'description'     => null,
                'username'      => 'ahmedemon',
                'email'          => 'ahmedemon@gmail.com',
                'phone'          => '01950594252',
                'password'       => bcrypt('ahmedemon'), // password
                'paintings'          => null,
                'email_verified_at' => now(),
                'remember_token' => null,
                'privacy_policy' => 1,
                'is_active' => 0,
                'is_approved' => 0,
                'is_blocked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image'     => null,
                'name'     => null,
                'description'     => null,
                'username'      => 'ejazgazi',
                'email'          => 'ejazgazi@gmail.com',
                'phone'          => '01950594251',
                'password'       => bcrypt('ahmedemon'), // password
                'paintings'          => null,
                'email_verified_at' => now(),
                'remember_token' => null,
                'privacy_policy' => 1,
                'is_active' => 0,
                'is_approved' => 0,
                'is_blocked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
