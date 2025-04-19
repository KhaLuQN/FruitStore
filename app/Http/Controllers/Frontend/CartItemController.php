<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;

class CartItemController extends Controller
{
    /**
     * Thêm sản phẩm vào giỏ hàng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::updateOrCreate(
            [
                'cart_id' => $request->cart_id,
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => $request->quantity,
            ]
        );
        $this->updateCartQuantity($request->cart_id);
        return response()->json($cartItem, 201);
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'cart_item_id' => 'required|integer',
        ]);

        $cartItem = CartItem::find($request->cart_item_id);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Sản phẩm không tìm thấy trong giỏ.');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        $this->updateCartQuantity($cartItem->cart_id);
        return redirect()->route('cart.show')->with('success', 'Giỏ hàng đã được cập nhật.');
    }





    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        $cartId = $cartItem->cart_id;
        $cartItem->delete();
        $this->updateCartQuantity($cartId);
        return redirect()->back()->with('success', 'Mục đã được xóa khỏi giỏ hàng.');
    }
    private function updateCartQuantity($cartId)
    {
        $cart = Cart::with('cartItems')->find($cartId);

        if ($cart) {
            $cartQuantity = $cart->cartItems->sum('quantity');
            session(['cart_quantity' => $cartQuantity]);
        }
    }
}
