<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    /**
     * Hiển thị trang chính.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.pages.404');
    }
}
