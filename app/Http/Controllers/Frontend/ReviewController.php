<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request, $productId)
    {
        $user = auth()->user();


        $existingReview = Review::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();


        if ($existingReview) {

            $existingReview->update([
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);
        } else {

            $request->validate([
                'rating' => 'required|integer|between:1,5',
                'comment' => 'required|string|max:500',
            ]);


            $hasBought = $user->orders()->whereHas('orderItems', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })->exists();

            if (!$hasBought) {
                return redirect()->back()->with('error', 'Bạn phải mua sản phẩm này trước khi có thể đánh giá.');
            }

            // Lưu bình luận và đánh giá
            $review = new Review();
            $review->rating = $request->input('rating');
            $review->comment = $request->input('comment');
            $review->product_id = $productId;
            $review->user_id = auth()->id();
            $review->save();
        }

        return redirect()->back()->with('success', 'Bình luận và đánh giá đã được gửi.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
