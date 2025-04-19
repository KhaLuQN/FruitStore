<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo dữ liệu cho bảng categories
        DB::table('categories')->insert([
            [
                'name' => 'Fruits',
                'description' => $faker->text,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vegetables',
                'description' => $faker->text,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Thêm các mục khác nếu cần
        ]);
    }
}
