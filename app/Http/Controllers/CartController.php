<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // लगइन भएको युजरको कार्ट आइडी पत्ता लगाउने वा नभए नयाँ बनाउने फङ्सन
    private function getOrCreateUserCart()
    {
        // यदि युजर लगइन छैन भने लगइन वा सेसनमा पठाउन सकिन्छ (यहाँ लगइन युजरको लागि हो)
        return Cart::firstOrCreate([
            'user_id' => Auth::guard('customer')->id()
        ]);
    }

    // १. कार्ट पेज: डेटाबेसको 'cart_items' बाट सामानहरू देखाउने
    public function index()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Please login to view cart');
        }

        $cartHeader = $this->getOrCreateUserCart();
        
        // कार्टका आइटमहरू प्रडक्टको विवरण सहित डेटाबेसबाट तान्ने
        $cartItems = CartItem::where('cart_id', $cartHeader->id)->with('product')->get();

        $subtotal = 0;
        $discount = 0;
        $cart = [];

        foreach ($cartItems as $item) {
            $product = $item->product;
            if (!$product) continue;

            // तपाईँको म्याग्रेसन अनुसार प्रडक्टकै वा आइटम टेबलको मूल्य लिने
            $price = $product->price;
            $discountedPrice = $product->discounted_price;
            $qty = $item->quantity;

            $subtotal += $price * $qty;
            if ($discountedPrice) {
                $discount += ($price - $discountedPrice) * $qty;
            }

            // तपाईँको ब्लेड फाइलको Array संरचनासँग मिलाएको
            $cart[$item->id] = [
                'name' => $product->name,
                'quantity' => $qty,
                'price' => $price,
                'discounted_price' => $discountedPrice,
                'thumbnail' => $product->thumbnail,
                'brand' => $product->brand ?? 'Official Store',
            ];
        }

        $total = $subtotal - $discount;

        return view('frontend.cart', compact('cart', 'subtotal', 'discount', 'total'));
    }

    // २. Add to Cart: सामान डेटाबेसमा सेभ गर्ने
    public function add(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'product_variant_id' => 'nullable|exists:product_variants,id'
        ]);

        $product = Product::findOrFail($request->product_id);
        $userCart = $this->getOrCreateUserCart();
        
        $quantity = $request->quantity ?? 1;
        // डिस्काउन्टेड मूल्य छ भने त्यही राख्ने, नत्र साधारण मूल्य राख्ने
        $finalPrice = $product->discounted_price ?? $product->price;

        // यदि यो सामान पहिले नै कार्टमा छ भने मात्रा मात्र बढाउने
        $existingItem = CartItem::where('cart_id', $userCart->id)
            ->where('product_id', $product->id)
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);
        } else {
            // छैन भने `cart_items` टेबलमा नयाँ रो (Row) थप्ने
            CartItem::create([
                'cart_id' => $userCart->id,
                'product_id' => $product->id,
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $quantity,
                'price' => $finalPrice
            ]);
        }

        if ($request->has('buy_now')) {
            return redirect()->route('cart.index');
        }

        return redirect()->back()->with('success', 'Product added to database cart successfully!');
    }

    // ३. AJAX Update: + र - थिच्दा परिमाण डेटाबेसमा अपडेट गर्ने
    public function update(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $userCart = $this->getOrCreateUserCart();
        
        // सुरक्षाको लागि यो आइटम सम्बन्धित युजरकै कार्टको हो भनी पक्का गर्ने
        $cartItem = CartItem::where('cart_id', $userCart->id)->where('id', $request->id)->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => intval($request->quantity)
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Quantity updated successfully in DB'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cart item not found'
        ], 400);
    }

    // ४. Remove Item: कार्टबाट सामान हटाउने
    public function remove($id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login');
        }

        $userCart = $this->getOrCreateUserCart();
        $cartItem = CartItem::where('cart_id', $userCart->id)->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}