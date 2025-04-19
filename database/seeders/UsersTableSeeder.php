<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo 1 admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@123.com',
            'password' => Hash::make('password'),
            'phone' => $faker->phoneNumber,
            'province_id' => 1, // Thay thế giá trị này với ID thích hợp
            'district_id' => 1, // Thay thế giá trị này với ID thích hợp
            'ward_id' => 1, // Thay thế giá trị này với ID thích hợp
            'address' => $faker->address,
            'birthday' => $faker->date,
            'image' => $faker->imageUrl,
            'description' => $faker->text,
            'user_agent' => $faker->userAgent,
            'ip' => $faker->ipv4,
            'role' => 'admin', // assuming there's a 'role' field
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Tạo 4 staff
        for ($i = 0; $i < 4; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'phone' => $faker->phoneNumber,
                'province_id' => rand(1, 100), // Thay thế giá trị này với ID thích hợp
                'district_id' => rand(1, 100), // Thay thế giá trị này với ID thích hợp
                'ward_id' => rand(1, 100), // Thay thế giá trị này với ID thích hợp
                'address' => $faker->address,
                'birthday' => $faker->date,
                'image' => $faker->imageUrl,
                'description' => $faker->text,
                'user_agent' => $faker->userAgent,
                'ip' => $faker->ipv4,
                'role' => 'staff', // assuming there's a 'role' field
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Tạo 100 người dùng
        for ($i = 0; $i < 100; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'phone' => $faker->phoneNumber,
                'province_id' => rand(1, 100), // Thay thế giá trị này với ID thích hợp
                'district_id' => rand(1, 100), // Thay thế giá trị này với ID thích hợp
                'ward_id' => rand(1, 100), // Thay thế giá trị này với ID thích hợp
                'address' => $faker->address,
                'birthday' => $faker->date,
                'image' => $faker->imageUrl,
                'description' => $faker->text,
                'user_agent' => $faker->userAgent,
                'ip' => $faker->ipv4,
                'role' => 'user', // assuming there's a 'role' field
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
