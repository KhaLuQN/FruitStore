<?php

namespace App\Http\Controllers\Frontend;

use App\Models\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Hiển thị trang checkout (địa chỉ và phương thức thanh toán)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('frontend.pages.processcheckout');
    }
}
