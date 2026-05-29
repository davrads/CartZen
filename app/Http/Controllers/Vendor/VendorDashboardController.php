<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class VendorDashboardController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;
        $productsCount = Product::where('vendor_id', $vendor->id)->count();
        $ordersCount = Order::whereHas('items.product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->count();
        return view('vendor.dashboard', compact('productsCount', 'ordersCount'));
    }
}