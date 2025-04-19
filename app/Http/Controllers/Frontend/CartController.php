<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;

class CartController extends Controller
{
    /**
     * Tạo giỏ hàng mới cho người dùng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $userId = Auth::id();


        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $userId
            ]);
        }
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {

            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {

            $product = Product::findOrFail($request->product_id);
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'image' => $product->image
            ]);
        }
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $totalQuantity = $cartItems->sum('quantity');
        session(['cart_quantity' => $totalQuantity]);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }



    /**
     * Lấy giỏ hàng của người dùng.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            $cart = Cart::create(['user_id' => $userId]);
        }

        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with('product')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $discount = session('discount', 0);
        $discountAmount = $total * ($discount / 100);
        $finalTotal = $total - $discountAmount;

        return view('frontend.pages.cart', [
            'cartItems' => $cartItems,
            'total' => $total,
            'discount' => $discount,
            'finalTotal' => $finalTotal,
        ]);
    }

    /**
     * Xóa giỏ hàng.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function delete($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cart->delete();

        return response()->json(['message' => 'Cart deleted successfully']);
    }



    public function checkout(Request $request)
    {

        $cartItems = json_decode($request->input('cart_items'), true);

        if (empty($cartItems)) {
            return redirect()->route('cart.show')->with('error', 'Không có sản phẩm trong giỏ hàng.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['quantity'] * $item['product']['price'];
        }
        $discount = session('discount', 0);

        $discountAmount = $total * ($discount / 100);

        $finalTotal = $total - $discountAmount;
        $user = Auth::user();
        $name = $user ? $user->name : '';
        $phone = $user ? $user->phone : '';
        $address = $user ? $user->address : '';

        return view('frontend.pages.processcheckout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'discount' => $discount,
            'finalTotal' => $finalTotal,
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
        ]);
    }
}
