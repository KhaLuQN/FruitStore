<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class VerifyEmailController extends Controller
{
    public function verify($token)
    {

        $pendingUser = DB::table('pending_users')->where('verification_token', $token)->first();

        if (!$pendingUser) {
            return redirect()->route('home')->withErrors(['email' => 'Mã xác thực không hợp lệ.']);
        }


        User::create([
            'name' => $pendingUser->name,
            'email' => $pendingUser->email,
            'password' => $pendingUser->password,
        ]);


        DB::table('pending_users')->where('verification_token', $token)->delete();

        return redirect()->route('login')->with('success', 'Tài khoản đã được xác thực thành công.bạn có thể đăng nhập');
    }
}
