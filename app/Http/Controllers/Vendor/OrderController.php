<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a list of orders that contain products from the logged‑in vendor.
     */
    public function index()
    {
        $vendorId = Auth::user()->vendor->id;

        // Fetch all order items belonging to this vendor, with the order and product relationships
        $orderItems = OrderItem::with(['order.user', 'product'])
            ->where('vendor_id', $vendorId)
            ->latest()
            ->paginate(15);

        // Group by order_id for easier display (optional, but kept simple for clarity)
        $orders = [];
        foreach ($orderItems as $item) {
            $orders[$item->order_id]['order'] = $item->order;
            $orders[$item->order_id]['items'][] = $item;
        }

        return view('vendor.orders.index', compact('orders', 'orderItems'));
    }

    /**
     * Show a specific order detail (optional, but useful).
     */
    public function show($orderId)
    {
        $vendorId = Auth::user()->vendor->id;

        $orderItems = OrderItem::with(['order.user', 'product'])
            ->where('vendor_id', $vendorId)
            ->where('order_id', $orderId)
            ->get();

        if ($orderItems->isEmpty()) {
            abort(404, 'Order not found for this vendor.');
        }

        $order = $orderItems->first()->order;

        return view('vendor.orders.show', compact('order', 'orderItems'));
    }
}