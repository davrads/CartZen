<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'flash_price' => 'decimal:2',
        'start_date'  => 'datetime',
        'end_date'    => 'datetime',
        'is_active'   => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Currently active flash sales.
     */
    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    /**
     * Upcoming flash sales.
     */
    public function scopeUpcoming($query)
    {
        return $query
            ->where('is_active', true)
            ->where('start_date', '>', now());
    }

    /**
     * Expired flash sales.
     */
    public function scopeExpired($query)
    {
        return $query
            ->where('end_date', '<', now());
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->is_active
            && now()->between($this->start_date, $this->end_date);
    }

    public function getDiscountPercentAttribute(): int
    {
        if (! $this->product || $this->product->price <= 0) {
            return 0;
        }

        return (int) round(
            (($this->product->price - $this->flash_price) / $this->product->price) * 100
        );
    }

    public function getDiscountPercentFormattedAttribute(): string
    {
        return $this->discount_percent . '%';
    }

    public function getRemainingTimeAttribute(): ?string
    {
        if (! $this->isActive()) {
            return null;
        }

        return now()->diffForHumans(
            $this->end_date,
            [
                'parts' => 3,
                'short' => true,
            ]
        );
    }
}