<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
  
    public function remove($id)
    {
        $wishlist = session()->get('wishlistItems', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]); // उक्त सामानलाई सूचीबाट हटाउने
            session()->put('wishlistItems', $wishlist); // नयाँ सूची सेसनमा सेभ गर्ने
        }

        return redirect()->back()->with('success', 'सामान विसलिस्टबाट सफलतापूर्वक हटाइयो।');
    }

    public function toCart($id)
    {
        $wishlist = session()->get('wishlistItems', []);
        $cart = session()->get('cart', []);

        if (isset($wishlist[$id])) {
            $item = $wishlist[$id];

          
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $item['quantity'];
            } else {
                $cart[$id] = [
                    "name" => $item['name'],
                    "quantity" => $item['quantity'],
                    "price" => $item['price'],
                    "image" => $item['image'] ?? null
                ];
            }

           
            unset($wishlist[$id]);
            session()->put('cart', $cart);
            session()->put('wishlistItems', $wishlist);

            return redirect()->back()->with('success', 'सामान सफलतापूर्वक कार्टमा थपियो।');
        }

        return redirect()->back()->with('error', 'सामान फेला परेन।');
    }
}