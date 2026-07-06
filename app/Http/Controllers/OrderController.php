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

           
            CartItem::where('cart_id', $cart->id)->delete();

            // Khalti API 
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
    "amount" => $order->total_amount * 100,
    "purchase_order_id" => $order->order_number,
    "purchase_order_name" => "Order #" . $order->order_number,
]);

                if ($response->successful() && isset($response['payment_url'])) {
                    DB::commit(); 
                    return redirect($response['payment_url']); 
                } else {
                    throw new \Exception('खल्ती गेटवेमा समस्या आयो: ' . $response->body());
                }
            }

            // यदि Cash on Delivery (COD) हो भने सिधै होमपेजमा पठाउने
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
        // नोट: यदि ब्याकइन्डमा सिधै डेटा अपडेट गराउने हो भने तलको return हटाउन सक्नुहुन्छ
       // return $request->all();
        
        $order = Order::find($request['purchase_order_id']);
        if ($order) {
            $order->status = $request['status'];
            $order->khalti_pidx = $request['transaction_id'];
            $order->save();
        }
        return redirect()->route('order.history');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::guard('customer')->id())->get();
        return view('frontend.order_history', compact('orders'));
    }
}