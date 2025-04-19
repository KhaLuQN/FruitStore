<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
        'final_total',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'notes',
        'discount',
        'payment_method',
    ];

    /**
     * Mối quan hệ 1-n với bảng OrderItems
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    /**
     * Mối quan hệ với bảng User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
