<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true)
                     ->where('starts_at', '<=', now())
                     ->where('ends_at', '>', now());
    }
}   
