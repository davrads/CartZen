<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorApplication extends Model
{
    protected $fillable = [
        'owner_name',
        'shop_name',
        'email',
        'phone',
        'address',
        'description',
        'shop_logo',
        'pan_card',
        'status',
        'remarks',
    ];
}
