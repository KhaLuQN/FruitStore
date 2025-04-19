<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product; // Import Product model

class ProductDetailsSeeder extends Seeder
{
    public function run()
    {
        // Lấy tất cả các sản phẩm từ bảng products
        $products = Product::all();

        foreach ($products as $product) {
            // Thêm dữ liệu cho mỗi sản phẩm vào bảng product_details
            DB::table('product_details')->insert([
                'product_id' => $product->id,
                'additional_image_1' => 'fruite-item-4.jpg',
                'additional_image_2' => 'fruite-item-5.jpg',
                'additional_image_3' => 'fruite-item-6.jpg',
                'long_description' => 'Mô tả dài cho sản phẩm ID: ' . $product->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
