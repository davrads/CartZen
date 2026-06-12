<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor;
        $productsCount = Product::where('vendor_id', $vendor->id)->count();
        $orders = OrderItem::with('order')->where('vendor_id', $vendor->id)->get();
        $totalSales = $orders->sum('price');
        $pendingOrders = $orders->where('order.status', 'pending')->count();

        return view('vendor.dashboard', compact('productsCount', 'totalSales', 'pendingOrders'));
    }
}