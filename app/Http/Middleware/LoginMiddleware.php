<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
    // Lấy người dùng hiện tại
    $user = Auth::user();

    // Kiểm tra vai trò của người dùng
    if ($user->role === 'admin' || $user->role === 'staff') {
        // Nếu người dùng là admin hoặc staff, chuyển hướng đến trang dashboard
        return redirect()->route('dashboard.index');
    } else {
        // Nếu người dùng không phải admin hoặc staff, chuyển hướng đến trang home
        return redirect()->route('home');
    }
}

// Nếu người dùng chưa đăng nhập, tiếp tục yêu cầu
return $next($request);

    }
}
