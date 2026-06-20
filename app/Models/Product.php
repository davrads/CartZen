<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'vendor_id',
        'category_id',
        'name',
        'slug',
        'description',
        'brand',
        'sku',
        'price',
        'discounted_price',
        'stock',
        'thumbnail',
        'status',
        'featured'
    ];
    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function variants(){
        return $this->hasMany(ProductVariant::class);
    }
}
