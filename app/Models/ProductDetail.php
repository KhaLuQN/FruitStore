<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_id',
        'additional_image_1',
        'additional_image_2',
        'additional_image_3',
        'long_description',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
