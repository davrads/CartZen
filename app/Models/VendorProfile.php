<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VendorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'shop_name',
        'shop_slug',
        'shop_logo',
        'description',
        'phone',
        'email',
        'address',
        'pan_number',
        'account_number',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    public function getRouteKeyName()
    {
        return 'shop_slug';
    }
}
