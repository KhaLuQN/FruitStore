<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show()
    {

        $user = auth()->user();


        return view('frontend.pages.profile', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|max:2048',
        ]);



        if ($request->password) {
            $user->password = bcrypt($request->password);
        }


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('users', 'public');
            $user->image = $path;
        }

        $user->update($request);


        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
