<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        return view('checkout.index', compact('cartItems', 'subtotal'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:razorpay',
        ]);

        $cartItems = Cart::with('product.vendor')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'shipping_address' => $request->shipping_address,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'vendor_id' => $item->product->vendor_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Razorpay integration
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt' => $order->order_number,
                'amount' => $total * 100,
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);

            Payment::create([
                'order_id' => $order->id,
                'transaction_id' => $razorpayOrder->id,
                'amount' => $total,
                'status' => 'pending',
                'payment_gateway' => 'razorpay',
            ]);

            DB::commit();

            return view('checkout.pay', [
                'order' => $order,
                'razorpayOrder' => $razorpayOrder,
                'key' => env('RAZORPAY_KEY'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id' => $input['razorpay_order_id'],
                'razorpay_payment_id' => $input['razorpay_payment_id'],
                'razorpay_signature' => $input['razorpay_signature'],
            ];
            $api->utility->verifyPaymentSignature($attributes);

            $payment = Payment::where('transaction_id', $input['razorpay_order_id'])->firstOrFail();
            $payment->update([
                'transaction_id' => $input['razorpay_payment_id'],
                'status' => 'paid',
                'gateway_response' => json_encode($input),
            ]);

            $order = $payment->order;
            $order->update(['payment_status' => 'paid', 'status' => 'processing']);

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            return view('checkout.success', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
}