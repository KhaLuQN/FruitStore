<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetail;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index(Request $request)
    {
        $config = $this->config();
        $template = "backend.products.index";
        $search = $request->input('search', '');
        $currentDate = Carbon::now();
        $perPage = $request->input('perpage', 20);
        $group = $request->input('group', 0);


        $productsQuery = $this->applyFilters(Product::query(), $search, $group);


        $products = $productsQuery->paginate($perPage);


        $this->calculateExpirationDays($products, $currentDate);

        return view('backend.welcome', compact('template', 'config', 'products'));
    }

    private function config()
    {
        return [
            'js' => [
                'backend/js/inspinia.js',
                'backend/js/plugins/switchery/switchery.js',
                'backend/js/inspinia.js'
            ],
            'css' => ['backend/font-awesome/css/font-awesome.css', 'backend/css/plugins/switchery/switchery.css'],
        ];
    }

    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        $isInCart = DB::table('cart_items')->where('product_id', $product->id)->exists();

        if ($isInCart) {

            return redirect()->route('products.index')->with('error', 'Sản phẩm đang có trong giỏ hàng của người dùng.');
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xoá sản phẩm thành công.');
    }


    //Hiển thị trang sửa
    public function edit($id)
    {
        $categories = \App\Models\Category::all();
        $config = $this->config();
        $template = 'backend.products.component.edit';
        $product = Product::findOrFail($id);

        return view('backend.welcome', compact('template', 'config', 'product', 'categories'));
    }



    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'product_type' => 'required|in:imported,domestic',
        ]);


        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
            $validatedData['image'] = $imageName;
        }

        // Cập nhật sản phẩm
        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật');
    }



    public function create()
    {
        $categories = \App\Models\Category::all();
        $template = 'backend.products.component.add';
        $config =
            [
                'js' => [
                    'backend/js/inspinia.js',
                    'backend/js/plugins/dropzone/dropzone.js',
                    'backend/js/plugins/summernote/summernote.min.js',
                    'backend/css/plugins/datapicker/datepicker3.css'
                ],
                'css' => [
                    'backend/css/plugins/summernote/summernote.css',

                    'backend/css/plugins/summernote/summernote-bs3.css'
                ],
            ];

        return view(
            'backend.welcome',
            compact('template', 'config', 'categories')
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'product_type' => 'required|in:imported,domestic',
            'expiration_date' => 'nullable|date',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $validatedData['description'] = strip_tags($validatedData['description']);
        $validatedData['long_description'] = strip_tags($validatedData['long_description']);
        $validatedData['description'] = html_entity_decode($validatedData['description']);
        $validatedData['long_description'] = html_entity_decode($validatedData['long_description']);

        // Lưu ảnh chính
        $fileName = null;
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $fileName);
        }

        // Tạo sản phẩm mới
        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'category_id' => $validatedData['category_id'],
            'product_type' => $validatedData['product_type'],
            'expiration_date' => $validatedData['expiration_date'],
            'image' => $fileName,
        ]);


        $images = ['additional_image_1', 'additional_image_2', 'additional_image_3'];
        $imageNames = [];
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                $img = $request->file($image);
                $imageName = time() . '-' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->storeAs('public/products', $imageName);
                $imageNames[$image] = $imageName;
            }
        }


        $details = new ProductDetail();
        $details->product_id = $product->id;
        $details->long_description = $validatedData['long_description'];


        foreach ($imageNames as $key => $imageName) {
            $details->{$key} = $imageName;
        }


        $details->save();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }





    // Áp dụng bộ lọc tìm kiếm và nhóm
    private function applyFilters($query, $search, $group)
    {
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('id', $search);
            });
        }

        if ($group > 0) {
            $query->where(function ($q) use ($group) {
                switch ($group) {
                    case 1:
                        $q->where('product_type', 1);
                        break;
                    case 2:
                        $q->where('product_type', 2);
                        break;
                }
            });
        }

        return $query;
    }


    private function calculateExpirationDays($products, $currentDate)
    {
        foreach ($products as $product) {
            if ($product->expiration_date) {
                $expirationDate = Carbon::parse($product->expiration_date);
                $daysLeft = $expirationDate->diffInDays($currentDate, false);
                $product->HSD = $daysLeft > 0 ? $daysLeft : "hết hạn";
            } else {
                $product->HSD = null;
            }
        }
    }

    public function updateSale(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        $product->is_sale = $request->has('is_sale') ? 1 : 0;

        $product->save();

        return redirect()->back();
    }
}
