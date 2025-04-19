<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ với các sản phẩm của danh mục rau củ và trái cây.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {



        $vegetableCategory = Category::where('name', 'Vegetables')->first();
        $vegetableProducts = $vegetableCategory
            ? Product::select('id', 'name', 'price', 'image', 'description')
            ->where('category_id', $vegetableCategory->id)
            ->get()
            : collect();
        $imageCategories = Category::select('name', 'image')->get();


        $fruitCategory = Category::where('name', 'Trái cây')->first();
        $fruitProducts = $fruitCategory
            ? Product::select('id', 'name', 'price', 'image', 'description')
            ->where('category_id', $fruitCategory->id)
            ->get()
            : collect();

        $bestSellingProducts = Product::orderBy('sold_quantity', 'desc')->take(10)->get();
        $onSaleProducts = Product::onSale()->get();
        $maxDiscountProduct = $onSaleProducts->sortByDesc('discount_percentage')->first();
        $reviews = Review::where('rating', 5)->limit(10)->get();
        foreach ($vegetableProducts as $product) {
            $product->average_rating = $product->averageRating();
        }

        foreach ($fruitProducts as $product) {
            $product->average_rating = $product->averageRating();
        }

        foreach ($onSaleProducts as $product) {
            $product->average_rating = $product->averageRating();
        }

        foreach ($bestSellingProducts as $product) {
            $product->average_rating = $product->averageRating();
        }
        return view('frontend.pages.home', compact(
            'vegetableProducts',
            'vegetableCategory',
            'fruitProducts',
            'fruitCategory',
            'onSaleProducts',
            'bestSellingProducts',
            'reviews',
            'imageCategories',
            'maxDiscountProduct'
        ));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        if (empty($searchTerm)) {
            $products = Product::all();
        } else {

            $products = Product::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
        }
        return view('frontend.pages.product-search', compact('products', 'searchTerm'));
    }
}
