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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'required',
            'payment_method' => 'required',
        ]);

        $userId = Auth::guard('customer')->id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'कृपया पहिले लगइन गर्नुहोस्।');
        }

        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'तपाईंको कार्ट खाली फेला पर्यो!');
        }

        $cartItems = CartItem::with('product')
            ->where('cart_id', $cart->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'तपाईंको कार्ट खाली फेला पर्यो!');
        }

        DB::beginTransaction();

        try {
            $subTotal = 0;
            foreach ($cartItems as $item) {
                $price = $item->price ?? optional($item->product)->price ?? 0;
                $subTotal += $price * $item->quantity;
            }

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

            // Khalti Payment
            if ($request->payment_method === 'khalti') {
                $url = env('KHALTI_BASE_URL') . '/epayment/initiate/';
                
                $response = Http::withHeaders([
                    'Authorization' => 'Key ' . env('KHALTI_SECRET')
                ])
                ->timeout(30)
                ->withoutVerifying() 
                ->post($url, [
                    "return_url" => route('khalti.callback'),
                    "website_url" => url('/'), 
                    "amount" => (int) round($order->total_amount * 100),
                    "purchase_order_id" => (string) $order->id, // Order ID नै पठाउने
                    "purchase_order_name" => "Order #" . $order->order_number,
                ]);

                if ($response->successful() && isset($response['payment_url'])) {
                    if (isset($response['pidx'])) {
                        $order->khalti_pidx = $response['pidx'];
                        $order->save();
                    }
                    
                    DB::commit(); 
                    // Note: कार्ट खाली गरिएको छैन, Khalti success भएपछि मात्र खाली हुन्छ।
                    return redirect($response['payment_url']); 
                } else {
                    throw new \Exception('खल्ती गेटवेमा समस्या आयो: ' . $response->body());
                }
            }

            // COD को लागि मात्र कार्ट खाली गर्ने
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

    public function callback(Request $request)
    {
        // Khalti v2 Response Parameter Check
        $pidx = $request->query('pidx');
        $status = $request->query('status');
        $purchaseOrderId = $request->query('purchase_order_id');

        // Order खोज्ने (ID, Order Number वा pidx बाट)
        $order = Order::where('id', $purchaseOrderId)
            ->orWhere('order_number', $purchaseOrderId)
            ->orWhere('khalti_pidx', $pidx)
            ->first();

        if ($order) {
            // यदि Khalti ले status नपठाएमा API call गरेर Verify गर्ने
            if ($pidx && strtolower($status) !== 'completed') {
                $verifyUrl = env('KHALTI_BASE_URL') . '/epayment/lookup/';
                $verifyResponse = Http::withHeaders([
                    'Authorization' => 'Key ' . env('KHALTI_SECRET')
                ])
                ->withoutVerifying()
                ->post($verifyUrl, ['pidx' => $pidx]);

                if ($verifyResponse->successful()) {
                    $status = $verifyResponse->json('status');
                }
            }

            if (strtolower($status) === 'completed') {
                $order->status = 'completed';
                $order->khalti_pidx = $pidx;
                $order->save();

                // ✅ पेमेन्ट सफल भएपछि मात्र कार्ट खाली गर्ने
                $userId = $order->user_id;
                $cart = Cart::where('user_id', $userId)->first();
                if ($cart) {
                    CartItem::where('cart_id', $cart->id)->delete();
                }

                return redirect()->route('order.history')->with('success', 'भुक्तानी सफल भयो! तपाईंको अर्डर स्वीकृत भयो।');
            } else {
                // पेमेन्ट क्यान्सिल भएमा वा असफल भएमा
                $order->status = 'canceled';
                $order->save();

                return redirect()->route('checkout')->with('error', 'भुक्तानी पूरा भएन वा रद्द गरियो। तपाईंको कार्टका सामानहरू सुरक्षित छन्।');
            }
        }

        return redirect()->route('checkout')->with('error', 'अर्डर फेला पर्न सकेन।');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::guard('customer')->id())->get();
        return view('frontend.order_history', compact('orders'));
    }
}