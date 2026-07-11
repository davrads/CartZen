<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'province',
        'district',
        'city',
        'address_line',
        'postal_code',     
        'created_at',
        'updated_at',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}