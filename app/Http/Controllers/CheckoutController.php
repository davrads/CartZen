<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        // Use the 'customer' guard
        $user = auth()->guard('customer')->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }

        $cart = Cart::with(['items.product.vendor'])
            ->where('user_id', $user->id)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $grouped = $cart->items->groupBy(function ($item) {
            return $item->product->vendor_id;
        });

        $vendorsData = [];
        $cartSubtotal = 0;
        $totalDiscount = 0;
        $totalShipping = 0;

        foreach ($grouped as $vendorId => $items) {
            $vendor = $items->first()->product->vendor;
            $vendorSubtotal = $items->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $vendorDiscount = 0; // placeholder
            $vendorShipping = optional($vendor->vendorProfile)->shipping_rate ?? 50;

            $vendorsData[] = [
                'vendor_id'   => $vendorId,
                'vendor_name' => $vendor->name ?? 'Vendor',
                'items'       => $items,
                'subtotal'    => $vendorSubtotal,
                'discount'    => $vendorDiscount,
                'shipping'    => $vendorShipping,
                'total'       => $vendorSubtotal - $vendorDiscount + $vendorShipping,
            ];

            $cartSubtotal  += $vendorSubtotal;
            $totalDiscount += $vendorDiscount;
            $totalShipping += $vendorShipping;
        }

        $grandTotal = $cartSubtotal - $totalDiscount + $totalShipping;

        $addresses = Address::where('user_id', $user->id)->get();

        return view('frontend.checkout', compact(
            'vendorsData',
            'cartSubtotal',
            'totalDiscount',
            'totalShipping',
            'grandTotal',
            'addresses'
        ));
    }

    public function placeOrder(Request $request)
    {
        $user = auth()->guard('customer')->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to place order.');
        }

        $request->validate([
            'address_id'     => 'required|exists:addresses,id',
            'payment_method' => 'required|in:cod,khalti',
        ]);

        $cart = Cart::with(['items.product'])
            ->where('user_id', $user->id)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $grouped = $cart->items->groupBy(function ($item) {
            return $item->product->vendor_id;
        });

        $meta = [];
        $totalShipping = 0;
        $subtotal = 0;
        $discount = 0;

        foreach ($grouped as $vendorId => $items) {
            $vendorSubtotal = $items->sum(fn($i) => $i->price * $i->quantity);
            $vendorDiscount = 0;
            $vendorShipping = optional($items->first()->product->vendor->vendorProfile)->shipping_rate ?? 50;

            $meta['vendors'][$vendorId] = [
                'subtotal' => $vendorSubtotal,
                'discount' => $vendorDiscount,
                'shipping' => $vendorShipping,
                'total'    => $vendorSubtotal - $vendorDiscount + $vendorShipping,
            ];

            $subtotal += $vendorSubtotal;
            $discount += $vendorDiscount;
            $totalShipping += $vendorShipping;
        }

        $grandTotal = $subtotal - $discount + $totalShipping;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id'         => $user->id,
                'address_id'      => $request->address_id,
                'order_number'    => 'ORD-' . strtoupper(Str::random(10)),
                'sub_total'       => $subtotal,
                'shipping_charge' => $totalShipping,
                'tax'             => 0,
                'discount'        => $discount,
                'total_amount'    => $grandTotal,
                'status'          => 'pending',
                'payment_method'  => $request->payment_method,
                'meta'            => $meta,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $item->product_id,
                    'vendor_id'     => $item->product->vendor_id,
                    'quantity'      => $item->quantity,
                    'price'         => $item->price,
                    'shipping_cost' => 0,
                ]);

                $product = Product::find($item->product_id);
                $product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();

            DB::commit();

            if ($request->payment_method === 'cod') {
                return redirect()->route('home')->with('success', 'Order placed successfully! You will pay on delivery.');
            }

            if ($request->payment_method === 'khalti') {
                return $this->initiateKhaltiPayment($order);
            }

            return redirect()->route('home')->with('success', 'Order placed!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    private function initiateKhaltiPayment($order)
    {
        $khaltiSecret = config('services.khalti.secret_key');
        $url = 'https://a.khalti.com/api/v2/epayment/initiate/';

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . $khaltiSecret,
        ])->post($url, [
            'return_url' => route('khalti.verify'),
            'website_url' => url('/'),
            'amount' => $order->total_amount * 100,
            'purchase_order_id' => $order->order_number,
            'purchase_order_name' => 'Order #' . $order->order_number,
            'customer_info' => [
                'name'  => auth()->guard('customer')->user()->name,
                'email' => auth()->guard('customer')->user()->email,
                'phone' => auth()->guard('customer')->user()->phone ?? '9800000000',
            ],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $order->khalti_pidx = $data['pidx'];
            $order->save();
            return redirect($data['payment_url']);
        }

        return back()->with('error', 'Khalti initiation failed. Please try again or choose COD.');
    }

    public function verifyKhalti(Request $request)
    {
        $pidx = $request->pidx;
        if (!$pidx) {
            return redirect()->route('home')->with('error', 'Invalid payment response.');
        }

        $khaltiSecret = config('services.khalti.secret_key');
        $url = 'https://a.khalti.com/api/v2/epayment/lookup/';

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . $khaltiSecret,
        ])->post($url, [
            'pidx' => $pidx,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] === 'Completed') {
                $order = Order::where('khalti_pidx', $pidx)->first();
                if ($order) {
                    $order->status = 'processing';
                    $order->save();
                    return redirect()->route('home')->with('success', 'Payment successful! Your order is confirmed.');
                }
            }
        }

        return redirect()->route('home')->with('error', 'Payment verification failed.');
    }
}


// namespace App\Http\Controllers;

// use App\Models\Order;
// use App\Models\OrderItem;
// use App\Models\Product;
// use Illuminate\Http\Request;

// class CheckoutController extends Controller
// {
//     public function index()
//     {
//         $cart = session()->get('cart', []);
//         return view('frontend.checkout', compact('cart'));
//     }

//     public function placeOrder(Request $request)
//     {
//         $cart = session()->get('cart', []);
//         if (empty($cart)) {
//             return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
//         }

//         $total = 0;
//         foreach ($cart as $item) {
//             $total += $item['price'] * $item['quantity'];
//         }

//         // $order = Order::create([
//         //     'user_id' => auth()->id(),
//         //     'total_amount' => $total,
//         //     'status' => 'pending',
//         //     'payment_status' => 'unpaid',
//         // ]);

//         // foreach ($cart as $id => $item) {
//         //     OrderItem::create([
//         //         'order_id' => $order->id,
//         //         'product_id' => $id,
//         //         'quantity' => $item['quantity'],
//         //         'price' => $item['price'],
//         //     ]);

// //             // Reduce stock
// //             $product = Product::find($id);
// //             $product->decrement('stock', $item['quantity']);
// //         }

// //         session()->forget('cart');
// //         return redirect()->route('home')->with('success', 'Order placed successfully!');
// //     }
//     }
// }