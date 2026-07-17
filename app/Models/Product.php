<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\FlashSale;

class Product extends Model
{
    protected $fillable = [
        'vendor_id',
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'brand',
        'sku',
        'price',
        'sale_price',
        'discounted_price',
        'compare_at_price',
        'stock',
        'stock_quantity',
        'thumbnail',
        'image',
        'status',
        'featured',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'stock' => 'integer',
        'stock_quantity' => 'integer',
    ];

   

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function flashSale()
    {
        return $this->hasOne(FlashSale::class);
    }

   public function getIsFlashSaleAttribute()
{
    return $this->flashSale()->exists();
}

    public function scopeFeatured($query)
    {
        return $query
            ->where('featured', true)
            ->where('status', 'available');
    }

 

    public function getRouteKeyName()
    {
        return 'slug';
    }
}