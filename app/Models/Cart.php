<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    // एउटा कार्ट भित्र धेरै आइटमहरू हुन्छन्
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}