<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\discount;

class DiscountsController extends Controller
{
    public function indexcode()
    {
        $config =
            [
                'js' => ['backend/js/inspinia.js'],
                'css' => [''],
            ];
        $template = 'backend.Discounts.index';

        $discounts = Discount::all();


        return view(
            'backend.welcome',
            compact('template', 'config', 'discounts',)
        );
    }
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'code' => 'required|string|unique:discounts,code',
            'percentage' => 'required|numeric|min:1|max:100',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        try {

            Discount::create($validatedData);

            return redirect()
                ->route('discounts.indexcode')
                ->with('success', 'Mã giảm giá đã được lưu thành công.');
        } catch (\Exception $e) {

            Log::error('Error creating discount: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['error' => 'Đã xảy ra lỗi khi lưu mã giảm giá. Vui lòng thử lại sau.'])
                ->withInput();
        }
    }


    public function destroy($id)
    {

        $discount = Discount::find($id);

        if ($discount) {
            $discount->delete();
            return redirect()->route('discounts.indexcode')->with('success', 'Mã giảm giá đã được xóa.');
        }

        return redirect()->route('discounts.indexcode')->with('error', 'Mã giảm giá không tồn tại.');
    }
}
