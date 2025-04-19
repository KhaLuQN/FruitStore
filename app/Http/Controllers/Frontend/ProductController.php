<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Hiển thị trang chính.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $category = $request->input('category', '');
        $minPrice = $request->input('min_price', '');
        $maxPrice = $request->input('max_price', '');
        $rating = $request->input('rating', '');

        $categories  = Category::all();
        $productsQuery = $this->applyFilters(Product::query(), $search, $category, $minPrice, $maxPrice, $rating);
        $products = $productsQuery->paginate(10);
        foreach ($products as $product) {
            $product->average_rating = $product->averageRating();
        }

        return view('frontend.pages.all-product', compact('products', 'categories'));
    }


    private function applyFilters($query, $search, $category, $minPrice, $maxPrice, $rating)
    {
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($category)) {
            if ($category == 'high-rated') {

                $query->whereHas('reviews', function ($query) {
                    $query->where('rating', 5);
                });
            } else {
                $query->where('category_id', $category);
            }
        }

        // Lọc theo giá tiền
        if (!empty($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }
        if (!empty($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }
        if ($rating) {
            $ratingValue = (int) filter_var($rating, FILTER_SANITIZE_NUMBER_INT);
            $query->withAvg('reviews', 'rating')
                ->having('reviews_avg_rating', '=', $ratingValue);
        }
        return $query;
    }


    public function detailProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Sản phẩm không tồn tại.');
        }
        $productDetails = ProductDetail::where('product_id', $product->id)->firstOrFail();


        $categoryName = $product->category ? $product->category->name : 'Không có danh mục';
        $averageRating = $product->averageRating();

        $reviews = $product->reviews;
        // dd($reviews);
        return view('frontend.pages.detailproduct', compact('product', 'categoryName', 'averageRating', 'productDetails', 'reviews'));
    }
}
