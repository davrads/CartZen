<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\FlashSale;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;

class Product extends Model
{
    protected $fillable = [
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
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function flashSale()
    { 
        return $this->hasOne(FlashSale::class); 
    }

    public function scopeFeatured($query) 
    { 
        return $query->where('is_featured', true); 
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
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
