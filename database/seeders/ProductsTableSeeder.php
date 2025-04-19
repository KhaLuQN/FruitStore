<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 1, 100), // giá từ 1 đến 100
                'quantity' => $faker->numberBetween(1, 100), // số lượng từ 1 đến 100
                'category_id' => $faker->numberBetween(1, 2), // Chọn ngẫu nhiên giữa 1 và 2
                'product_type' => $faker->randomElement(['imported', 'domestic']),
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'expiration_date' => $faker->dateTimeBetween('now', '+1 year'),
            ]);
        }
    }
}
