<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\FlashSale; // FlashSale Model थपियो
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private function getOrCreateUserCart()
    {
        return Cart::firstOrCreate([
            'user_id' => Auth::guard('customer')->id()
        ]);
    }

    public function index()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Please login to view cart');
        }

        $cartHeader = $this->getOrCreateUserCart();
        
        $cartItems = CartItem::where('cart_id', $cartHeader->id)->with('product')->get();

        $subtotal = 0;
        $discount = 0;
        $cart = [];

        foreach ($cartItems as $item) {
            $product = $item->product;
            if (!$product) continue;

            $price = $product->price;
            
            // यदि CartItem मा आफ्नो छुट्टै price छ भने (जस्तै Flash Sale price), त्यही प्रयोग गर्ने
            $itemPrice = $item->price ?? ($product->discounted_price ?? $product->price);
            $qty = $item->quantity;

            $subtotal += $price * $qty;
            
            // Original Price र actual Cart Price बिचको फरकलाई Discount मान्ने
            if ($price > $itemPrice) {
                $discount += ($price - $itemPrice) * $qty;
            }

            $cart[$item->id] = [
                'name' => $product->name,
                'quantity' => $qty,
                'price' => $price,
                'discounted_price' => $itemPrice < $price ? $itemPrice : null,
                'thumbnail' => $product->thumbnail,
                'brand' => $product->brand ?? 'Official Store',
            ];
        }

        $total = $subtotal - $discount;

        return view('frontend.cart', compact('cart', 'subtotal', 'discount', 'total'));
    }

    public function add(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'flash_sale_id' => 'nullable|exists:flash_sales,id', // Flash sale validation थपियो
            'quantity' => 'nullable|integer|min:1',
            'product_variant_id' => 'nullable|exists:product_variants,id'
        ]);

        $product = Product::findOrFail($request->product_id);
        $userCart = $this->getOrCreateUserCart();
        
        $quantity = $request->quantity ?? 1;
        
        // Default Final Price (Normal Discounted Price or Regular Price)
        $finalPrice = $product->discounted_price ?? $product->price;

        // यदि Flash Sale ID पठाएको छ भने Flash Sale active छ कि छैन भनेर चेक गर्ने
        if ($request->filled('flash_sale_id')) {
            $flashSale = FlashSale::where('id', $request->flash_sale_id)
                ->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if ($flashSale) {
                $finalPrice = $flashSale->flash_price; // Flash Price ले Price Override गर्छ
            }
        }

        $existingItem = CartItem::where('cart_id', $userCart->id)
            ->where('product_id', $product->id)
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);
            // यदि Flash Sale बाट आएको छ भने price update गर्ने
            if ($request->filled('flash_sale_id')) {
                $existingItem->update(['price' => $finalPrice]);
            }
        } else {
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

    public function update(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $userCart = $this->getOrCreateUserCart();
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

    public function moveToWishlist($id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Please login to perform this action');
        }

        $userCart = $this->getOrCreateUserCart();
        $cartItem = CartItem::where('cart_id', $userCart->id)
                            ->where('id', $id)
                            ->with('product')
                            ->first();

        if ($cartItem && $cartItem->product) {
            $product = $cartItem->product;
            
            $wishlist = session()->get('wishlist', []);
            $wishlist[$product->id] = [
                'name'     => $product->name,
                'price'    => $cartItem->price ?? $product->price,
                'quantity' => $cartItem->quantity,
                'image'    => $product->thumbnail ?? $product->image ?? null
            ];
            
            session()->put('wishlist', $wishlist);
            $cartItem->delete();
            session()->save(); 

            return redirect()->route('profile')->with('success', 'सामान सफलतापूर्वक Wishlist मा सारियो!');
        }

        return redirect()->back()->with('error', 'सामान कार्टमा फेला परेन।');
    }

    public function wishlistToCart($id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->with('error', 'Please login to perform this action');
        }

        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            $userCart = $this->getOrCreateUserCart();
            $product = Product::find($id);

            if ($product) {
                $finalPrice = $wishlist[$id]['price'] ?? ($product->discounted_price ?? $product->price);
                $quantity = $wishlist[$id]['quantity'] ?? 1;

                $existingItem = CartItem::where('cart_id', $userCart->id)
                    ->where('product_id', $product->id)
                    ->first();

                if ($existingItem) {
                    $existingItem->increment('quantity', $quantity);
                } else {
                    CartItem::create([
                        'cart_id' => $userCart->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $finalPrice
                    ]);
                }

                unset($wishlist[$id]);
                session()->put('wishlist', $wishlist);
                session()->save();

                return redirect()->route('cart.index')->with('success', 'सामान कार्टमा थपियो र विसलिस्टबाट हटाइयो!');
            }
        }

        return redirect()->back()->with('error', 'सामान विसलिस्टमा फेला परेन।');
    }

    public function removeFromWishlist($id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login');
        }

        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]); 
            
            session()->put('wishlist', $wishlist); 
            session()->save(); 

            return redirect()->back()->with('success', 'सामान विसलिस्टबाट सफलतापूर्वक हटाइयो।');
        }

        return redirect()->back()->with('error', 'सामान विसलिस्टमा फेला परेन।');
    }
}