<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use APP\Models\User;

class AuthController extends Controller
{
    public function __construct() {}

    public function index()
    {
        return view('auth.pages.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),

            'password' => $request->input('password')
        ];


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();


            session(['user_name' => $user->name]);

            return redirect()->route('dashboard.index')->with('success', 'đăng nhập thành công');
        }
        return redirect()->route('auth.login')->with('error', 'đăng nhập không thành công');
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
