<?php
// app/Http/Controllers/Backend/UserController.php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $perPage = $request->input('perpage', 20);
        $search_id = $request->input('search_id', '');

        $usersQuery = User::query();

        // Tìm kiếm người dùng
        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id', '=', $search)
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Tìm kiếm người dùng theo id
        if ($search_id !== '') {
            $usersQuery->where('id', '=', $search_id);
        }



        // Phân trang và lấy dữ liệu
        $users = $usersQuery->whereNotIn('role', ['admin', 'staff'])->paginate($perPage);

        // Giữ lại các tham số truy vấn trong phân trang
        $users->appends([
            'search' => $search,

            'perpage' => $perPage
        ]);

        $config = $this->config();
        $template = 'backend.user.index';

        return view('backend.welcome', compact('template', 'config', 'users'));
    }


    private function config()
    {
        return [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'backend/js/inspinia.js',

            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css'
            ],
        ];
    }

    // Phương thức để xóa user
    public function destroy($id)
    {

        $user = User::findOrFail($id);

        if (auth()->user()->role !== 'admin' || $user->role === 'admin') {
            return redirect()->route('user.index')->with('error', 'Bạn không có quyền xóa tài khoản này.');
        }

        $this->authorize('delete', $user);

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Tài khoản đã được xóa thành công');
    }

    public function create()
    {
        $template = 'backend.user.component.create';
        $config =
            [
                'js' => [''],
                'css' => [''],
            ];
        return view('backend.welcome', compact('template', 'config'));
    }



    public function store(Request $request)
    {

        $this->authorize('add', User::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string',
            'role' => 'required|string|in:admin,user,staff',

        ], [
            'email.unique' => 'Email này đã tồn tại trong hệ thống. Vui lòng chọn một email khác.',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('user.index')->with('success', 'Người dùng đã được thêm thành công');
    }
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);


        $user->update($validatedData);


        return redirect()->route('user.index')->with('success', 'Thông tin người dùng đã được cập nhật thành công!');
    }

    public function staff(Request $request)
    {
        $search = $request->input('search', '');
        $perPage = $request->input('perpage', 20);
        $search_id = $request->input('search_id', '');

        $usersQuery = User::query();

        // Tìm kiếm người dùng
        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id', '=', $search)
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Tìm kiếm người dùng theo id
        if ($search_id !== '') {
            $usersQuery->where('id', '=', $search_id);
        }



        // Phân trang và lấy dữ liệu
        $users = $usersQuery->whereNotIn('role', ['user', 'admin'])->paginate($perPage);

        // Giữ lại các tham số truy vấn trong phân trang
        $users->appends([
            'search' => $search,

            'perpage' => $perPage
        ]);

        $config = $this->config();
        $template = 'backend.manage_staff.index';

        return view('backend.welcome', compact('template', 'config', 'users'));
    }
}
