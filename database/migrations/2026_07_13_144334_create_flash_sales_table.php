<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;

class FlashSale extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'flash_price',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date'   => 'datetime',
        'end_date'     => 'datetime',
        'is_active'    => 'boolean',
        'flash_price'  => 'decimal:2',
    ];

    // ------------------------------------------------------------------
    // Relationships
    // ------------------------------------------------------------------

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // ------------------------------------------------------------------
    // Scopes (with safety checks)
    // ------------------------------------------------------------------

    /**
     * Scope to get only currently active flash sales.
     * If the required columns are missing, returns an empty query.
     */
    public function scopeActive($query)
    {
        // Check if the date columns exist to avoid SQL errors
        if (! $this->hasDateColumns()) {
            return $query->whereRaw('1 = 0'); // force empty result
        }

        return $query->where('is_active', true)
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }

    /**
     * Scope to get upcoming flash sales (not yet started).
     */
    public function scopeUpcoming($query)
    {
        if (! $this->hasDateColumns()) {
            return $query->whereRaw('1 = 0');
        }

        return $query->where('is_active', true)
                     ->where('start_date', '>', now());
    }

    /**
     * Scope to get expired flash sales (ended).
     */
    public function scopeExpired($query)
    {
        if (! $this->hasDateColumns()) {
            return $query->whereRaw('1 = 0');
        }

        return $query->where('end_date', '<', now());
    }

    // ------------------------------------------------------------------
    // Helper method to check columns
    // ------------------------------------------------------------------

    /**
     * Check if the required date columns exist in the table.
     */
    protected function hasDateColumns(): bool
    {
        return Schema::hasColumns($this->getTable(), ['start_date', 'end_date']);
    }

    // ------------------------------------------------------------------
    // Accessors & Helpers
    // ------------------------------------------------------------------

    /**
     * Check if this flash sale is currently active.
     */
    public function isActive(): bool
    {
        // If columns are missing, treat as inactive
        if (! $this->hasDateColumns()) {
            return false;
        }

        return $this->is_active
            && $this->start_date <= now()
            && $this->end_date >= now();
    }

    /**
     * Get the discount percentage based on the original product price.
     */
    public function getDiscountPercentAttribute(): float
    {
        $product = $this->product;
        if (! $product || $product->price <= 0 || ! $this->flash_price) {
            return 0;
        }
        return round((($product->price - $this->flash_price) / $product->price) * 100);
    }

    /**
     * Get the formatted discount percentage (e.g., "25%").
     */
    public function getDiscountPercentFormattedAttribute(): string
    {
        return $this->discount_percent . '%';
    }

    /**
     * Get the remaining time as a human‑readable string (for countdowns).
     */
    public function getRemainingTimeAttribute(): string
    {
        if (! $this->isActive()) {
            return 'Expired';
        }
        return $this->end_date->diffForHumans(now(), ['parts' => 2, 'join' => ', ']);
    }
}