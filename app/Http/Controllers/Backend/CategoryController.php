<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Import model Category

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {

        $categories = Category::all();

        $template = 'backend.categories.index';
        $config =
            [
                'js' => ['backend/js/inspinia.js'],
                'css' => [''],
            ];

        return view(
            'backend.welcome',
            compact('template', 'config', 'categories')
        );
    }

    // Hiển thị form tạo danh mục
    public function create()
    {

        $template = 'backend.categories.create';
        $config =
            [
                'js' => [
                    'backend/js/inspinia.js',
                    'backend/js/plugins/dropzone/dropzone.js',
                ],
                'css' => ['backend/css/plugins/dropzone/dropzone.css'],
            ];

        return view(
            'backend.welcome',
            compact('template', 'config',)
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/categories', $fileName);
        }
        Category::create([
            'name' => $request->name,
            'image' => $fileName,
            'description' => $request->description,
        ]);
        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công.');
    }



    public function edit(Category $category)
    {
        $template = 'backend.categories.edit';
        $config =
            [
                'js' => [
                    'backend/js/inspinia.js',
                    'backend/js/plugins/dropzone/dropzone.js',
                ],
                'css' => ['backend/css/plugins/dropzone/dropzone.css'],
            ];
        return view('backend.welcome', compact('template', 'config', 'category'));
    }


    // Cập nhật danh mục
    public function update(Request $request, Category $category)
    {
        // Validate và cập nhật danh mục
        $request->validate([
            'name' => 'required|string|max:191|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', ' cập nhật danh mục thành công.');
    }


    // Xóa danh mục
    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Không thể xóa danh mục vì đã chứa sản phẩm.');
        }


        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Xoá danh mục thành công');
    }
}
