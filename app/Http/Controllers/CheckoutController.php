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
use Illuminate\Support\Facades\Validator;
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

        // ✅ FIX: validate() ले fail हुँदा default back() जान्थ्यो, जुन प्रायः cart page मा
        // पुग्थ्यो (browser को अघिल्लो URL त्यही भएकोले)। अब explicit रूपमा checkout मा नै
        // errors सहित पठाइन्छ, ताकि user लाई किन order place भएन भन्ने देखियोस्।
        $validator = Validator::make($request->all(), [
            'address_id'     => 'required|exists:addresses,id',
            'payment_method' => 'required|in:cod,khalti',
        ]);

        if ($validator->fails()) {
            return redirect()->route('checkout')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'कृपया ठेगाना र पेमेन्ट विधि सही रूपमा छान्नुहोस्।');
        }

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
                    'status'       => 'pending',
                ]);

                $product = Product::find($item->product_id);
                $product->decrement('stock', $item->quantity);
            }

            // ✅ FIX: Khalti भएमा cart delete/commit गर्नु अघि पहिले payment initiate गर्ने।
            // पहिले जस्तो cart delete + commit गरेपछि Khalti fail भए, order/stock/commit
            // भइसकेको हुन्थ्यो तर cart फर्किंदैनथ्यो — permanent data loss हुन्थ्यो।
            if ($request->payment_method === 'khalti') {
                $khaltiResponse = $this->getKhaltiPaymentUrl($order);

                if (!$khaltiResponse) {
                    DB::rollBack();
                    return redirect()->route('checkout')->with('error', 'Khalti initiation failed. Please try again or choose COD.');
                }

                $cart->items()->delete();
                DB::commit();

                return redirect()->away($khaltiResponse);
            }

            $cart->items()->delete();
            DB::commit();

            if ($request->payment_method === 'cod') {
                return redirect()->route('home')->with('success', 'Order placed successfully! You will pay on delivery.');
            }

            return redirect()->route('home')->with('success', 'Order placed!');

        } catch (\Exception $e) {
            DB::rollBack();
            // ✅ FIX: back() को साटो checkout मा नै error देखाउने
            return redirect()->route('checkout')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Khalti payment initiate गरेर payment_url फर्काउँछ, fail भए null फर्काउँछ।
     * यसले $order मा khalti_pidx save गर्छ तर DB commit गर्दैन — त्यो placeOrder() मा हुन्छ।
     */
    private function getKhaltiPaymentUrl($order)
    {
        $khaltiSecret = config('services.khalti.secret_key');
        $url = 'https://a.khalti.com/api/v2/epayment/initiate/';

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . $khaltiSecret,
        ])
            ->when(app()->environment('local'), fn($http) => $http->withoutVerifying())
            ->post($url, [
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
            return $data['payment_url'];
        }

        \Illuminate\Support\Facades\Log::error('Khalti initiation failed: ' . $response->body());
        return null;
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
        ])
            ->when(app()->environment('local'), fn($http) => $http->withoutVerifying())
            ->post($url, [
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