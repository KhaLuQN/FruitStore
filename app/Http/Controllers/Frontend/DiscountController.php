<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function applyDiscount(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('cart.show')->with('error', 'Bạn cần phải đăng nhập để áp dụng mã giảm giá.');
        }

        if (session()->has('discount')) {
            return redirect()->route('cart.show')->with('error', 'Bạn đã áp dụng một mã giảm giá. Chỉ có thể áp dụng một mã giảm giá duy nhất.');
        }

        $request->validate([
            'discount_code' => 'required|string|exists:discounts,code',
        ]);

        $discount = Discount::where('code', $request->discount_code)->first();

        if (!$discount) {
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ.');
        }

        $currentDate = now()->toDateString();
        if ($discount->start_date > $currentDate || $discount->end_date < $currentDate) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết hạn.');
        }
        if ($discount->usage_count >= $discount->quantity) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết .');
        }
        session([
            'discount' => $discount->percentage,
            'discount_id' => $discount->id,
        ]);
        session()->save();

        return redirect()->route('cart.show')->with('success', 'Mã giảm giá đã được áp dụng.');
    }
}
