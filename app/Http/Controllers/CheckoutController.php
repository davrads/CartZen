<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('frontend.checkout', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // $order = Order::create([
        //     'user_id' => auth()->id(),
        //     'total_amount' => $total,
        //     'status' => 'pending',
        //     'payment_status' => 'unpaid',
        // ]);

        // foreach ($cart as $id => $item) {
        //     OrderItem::create([
        //         'order_id' => $order->id,
        //         'product_id' => $id,
        //         'quantity' => $item['quantity'],
        //         'price' => $item['price'],
        //     ]);

//             // Reduce stock
//             $product = Product::find($id);
//             $product->decrement('stock', $item['quantity']);
//         }

//         session()->forget('cart');
//         return redirect()->route('home')->with('success', 'Order placed successfully!');
//     }
    }
}