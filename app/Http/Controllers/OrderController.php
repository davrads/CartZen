<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // १. भ्यालिडेसन
        $request->validate([
            'address_id' => 'required',
            'payment_method' => 'required',
        ]);

        // २. लगइन युजर पत्ता लगाउने (checkout route 'customer' guard ले सुरक्षित छ)
        $userId = Auth::guard('customer')->id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'कृपया पहिले लगइन गर्नुहोस्।');
        }

        // ३. यो युजरको cart (header) पत्ता लगाउने
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'तपाईंको कार्ट खाली फेला पर्यो!');
        }

        // ४. cart_items टेबलबाट वास्तविक सामानहरू तान्ने (product सहित)
        $cartItems = CartItem::with('product')
            ->where('cart_id', $cart->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'तपाईंको कार्ट खाली फेला पर्यो!');
        }

        // ५. डेटाबेस ट्रान्ज्याक्सन
        DB::beginTransaction();

        try {
            // ६. रकम गणना
            $subTotal = 0;
            foreach ($cartItems as $item) {
                $price = $item->price ?? optional($item->product)->price ?? 0;
                $subTotal += $price * $item->quantity;
            }

            // ७. Orders टेबलमा सेभ
            $order = new Order();
            $order->user_id = $userId;
            $order->address_id = $request->address_id;
            $order->payment_method = $request->payment_method;
            $order->order_number = 'ORD-' . strtoupper(Str::random(10));
            $order->sub_total = $subTotal;
            $order->shipping_charge = 0;
            $order->tax = 0;
            $order->discount = 0;
            $order->total_amount = $subTotal;
            $order->status = 'pending';
            $order->save();

            // ८. Order Items टेबलमा सेभ (cart_items बाट)
            foreach ($cartItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->product_id;
                $orderItem->vendor_id = optional($item->product)->user_id;
                $orderItem->quantity = $item->quantity;
                $orderItem->price = $item->price ?? optional($item->product)->price ?? 0;
                $orderItem->shipping_cost = 0;
                $orderItem->save();
            }

            // ९. कार्ट खाली गर्ने (cart_items मात्र; cart header राखिन्छ)
            CartItem::where('cart_id', $cart->id)->delete();

            DB::commit();

            return redirect()->route('home')->with('success', 'तपाईंको अर्डर सफलतापूर्वक सुरक्षित भयो!');

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Place Order Failed: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return redirect()->back()->with('error', 'त्रुटि आयो: ' . $e->getMessage());
        }
    }
}