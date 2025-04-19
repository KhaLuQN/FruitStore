<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SalesController extends Controller
{
    public function index()
    {
        $products = Product::where('is_sale', true)->get();
        $config =
            [
                'js' => ['backend/js/inspinia.js'],
                'css' => [''],
            ];
        $template = 'backend.product_sales.index';
        return view(
            'backend.welcome',
            compact('template', 'config', 'products')
        );
    }


    public function updateDiscountPercentage(Request $request, $id)
    {
        $request->validate([
            'discount_percentage' => 'required|integer|min:0|max:100',
        ]);

        $product = Product::findOrFail($id);
        $product->discount_percentage = $request->input('discount_percentage');
        $product->save();

        return redirect()->back()->with('success', 'Discount percentage updated successfully!');
    }
}
