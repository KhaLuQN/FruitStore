<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    // Chỉ định bảng liên kết (nếu tên bảng không phải là dạng số nhiều của tên model)
    protected $table = 'discounts';

    // Các trường có thể được gán đại trà
    protected $fillable = [

        'code',
        'percentage',
        'start_date',
        'end_date',
        'quantity',
        'usage_count',
    ];

    // Các trường không thể được gán đại trà
    protected $guarded = [];

    // Các trường ngày tháng
    protected $dates = [
        'start_date',
        'end_date',
    ];
}
