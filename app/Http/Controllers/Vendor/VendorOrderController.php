<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;
        $orders = Order::whereHas('items.product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->with('user')->latest()->paginate(15);
        return view('vendor.orders.index', compact('orders'));
    }
}