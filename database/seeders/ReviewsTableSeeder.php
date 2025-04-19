<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Giả sử bạn đã có sẵn bảng `products` và `users` để lấy `product_id` và `user_id`
        $products = DB::table('products')->pluck('id')->toArray();
        $users = DB::table('users')->pluck('id')->toArray();

        // Kiểm tra dữ liệu tồn tại trước khi tạo seed
        if (empty($products) || empty($users)) {
            $this->command->info('No products or users available to seed reviews.');
            return;
        }

        // Tạo 50 đánh giá giả
        foreach (range(1, 30) as $index) {
            DB::table('reviews')->insert([
                'product_id' => $products[array_rand($products)], // Chọn ngẫu nhiên product_id
                'user_id' => $users[array_rand($users)],         // Chọn ngẫu nhiên user_id
                'rating' => rand(1, 5),                          // Rating từ 1 đến 5
                'comment' => Str::random(50),                    // Comment ngẫu nhiên 50 ký tự
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Reviews table seeded!');
    }
}
