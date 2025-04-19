<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::paginate(10);

        $config = $this->config();
        $template = "backend.reviews.index";
        return view('backend.welcome', compact('template', 'config', 'reviews'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reviews = Review::findOrFail($id);
        $reviews->delete();
        return redirect()->route('reviews.index')->with('success', 'Đánh giá  đã được xóa thành công');
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
}
