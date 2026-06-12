<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private function getSessionId()
    {
        if (!session()->has('cart_session')) {
            session()->put('cart_session', Str::random(40));
        }
        return session()->get('cart_session');
    }

    public function index()
    {
        $cartItems = $this->getCartItems();
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        return view('cart.index', compact('cartItems', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate(['quantity' => 'integer|min:1']);

        $cart = Cart::where(function ($q) {
            if (Auth::check()) {
                $q->where('user_id', Auth::id());
            } else {
                $q->where('session_id', $this->getSessionId());
            }
        })->where('product_id', $product->id)->first();

        if ($cart) {
            $cart->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'session_id' => !Auth::check() ? $this->getSessionId() : null,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', 'Cart updated');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed');
    }

    private function getCartItems()
    {
        return Cart::with('product')
            ->where(function ($q) {
                if (Auth::check()) {
                    $q->where('user_id', Auth::id());
                } else {
                    $q->where('session_id', $this->getSessionId());
                }
            })->get();
    }
}