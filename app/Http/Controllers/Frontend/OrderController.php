<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\cart;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cartItems = $request->input('cart');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $notes = $request->input('notes');

        $total = $request->input('total');
        $discount = $request->input('discount');
        $finalTotal = $total - ($total * $discount / 100);

        $order = Order::create([
            'user_id' => Auth::id(),
            'receiver_name' => $name,
            'receiver_phone' => $phone,
            'receiver_address' => $address,
            'notes' => $notes,
            'total' => $total,
            'final_total' => $finalTotal,
            'discount' => $discount,
            'status' => 'pending',
        ]);


        foreach ($cartItems as $item) {
            $totalPrice = $item['quantity'] * $item['price'];

            $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_price' => $totalPrice,
            ]);
        }
        Cart::where('user_id', Auth::id())->delete();


        $discount_id = session('discount_id');
        $cart_quantity = session('cart_quantity');
        $sessionKeys = ['discount', 'discount_code', 'cart_quantity'];

        foreach ($sessionKeys as $key) {
            if (session()->has($key)) {
                session()->forget($key);
            }
        }

        return redirect()->route('home')->with('success', 'đã đặt hàng thành công');
    }



    public function show()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)
            ->whereNotIn('status', ['cancelled', 'completed', 'out_for_delivery'])
            ->with('orderItems')
            ->get();


        if ($orders->isEmpty()) {
            return redirect()->route('home')->with('error', 'Bạn chưa có đơn hàng .');
        }

        $totalQuantity = $orders->sum(function ($order) {
            return $order->orderItems->sum('quantity');
        });

        return view('frontend.pages.orders', compact('orders', 'totalQuantity'));
    }

    public function ordersHistory()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)
            ->whereIn('status', ['cancelled', 'completed'])
            ->with('orderItems')
            ->paginate(5);
        if ($orders->isEmpty()) {
            return redirect()->route('home')->with('error', 'Đơn hàng không tồn tại.');
        }

        $totalQuantity = $orders->sum(function ($order) {
            return $order->orderItems->sum('quantity');
        });

        return view('frontend.pages.ordersHistory', compact('orders', 'totalQuantity'));
    }
}
