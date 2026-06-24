<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'product_variant_id', 'quantity', 'price'];

    // आइटम कुन प्रडक्टको हो भनी जोड्ने
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}