<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'product_type',
        'expiration_date',
        'image',
    ];
    /**
     * Get the category associated with the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * Scope lấy các sản phẩm đang có trạng thái is_sale
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnSale($query)
    {
        return $query->where('is_sale', true);
    }
    public function getPriceAttribute($value)
    {

        if ($this->is_sale && $this->discount_percentage) {

            return $value * (1 - $this->discount_percentage / 100);
        }
        return $value;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }


    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }
}
