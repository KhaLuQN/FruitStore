<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
    ];


    /**
     * Mối quan hệ với bảng Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Mối quan hệ với bảng Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
