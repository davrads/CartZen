<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder;

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
        'featured',           // boolean – featured product
        'is_flash_deal',      // NEW: boolean – flash deal active
        'flash_deal_ends_at', // NEW: datetime – when flash deal ends
    ];

    // Casts for proper data types
    protected $casts = [
        'price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'featured' => 'boolean',
        'is_flash_deal' => 'boolean',
        'flash_deal_ends_at' => 'datetime',
        'stock' => 'integer',
    ];

    // ------------------------------------------------------------------
    // Relationships
    // ------------------------------------------------------------------

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

    // ------------------------------------------------------------------
    // Scopes
    // ------------------------------------------------------------------

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope to get only products that are currently on flash deal.
     * Condition: is_flash_deal = true AND flash_deal_ends_at > now()
     */
    public function scopeActiveFlashDeal($query)
    {
        return $query->where('is_flash_deal', true)
                     ->where('flash_deal_ends_at', '>', now());
    }

    // ------------------------------------------------------------------
    // Accessors / Helpers
    // ------------------------------------------------------------------

    /**
     * Check if this product is currently on a flash deal.
     */
    public function getIsFlashDealActiveAttribute(): bool
    {
        return $this->is_flash_deal && $this->flash_deal_ends_at && $this->flash_deal_ends_at > now();
    }

    /**
     * Get the discount percentage if a flash deal is active.
     */
    public function getFlashDiscountPercentAttribute(): float
    {
        if (!$this->is_flash_deal_active || !$this->discounted_price || $this->price <= 0) {
            return 0;
        }
        return round((($this->price - $this->discounted_price) / $this->price) * 100);
    }

    /**
     * Route binding uses slug.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}