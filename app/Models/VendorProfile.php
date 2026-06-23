<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class VendorProfile extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class, 'vendor_id');
    }
}
