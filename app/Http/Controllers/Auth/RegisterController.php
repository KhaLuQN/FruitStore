<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    /**
     * Hiển thị form đăng ký.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.pages.register');
    }

    /**
     * 
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $verificationToken = Str::random(60);
        DB::table('pending_users')->insert([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'verification_token' => $verificationToken,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        Mail::to($validatedData['email'])->send(new EmailVerification($verificationToken));

        return redirect()->route('verification.notice')
            ->with('success', 'Đã lưu thông tin tài khoản. Vui lòng kiểm tra email để xác thực.');
    }
}
