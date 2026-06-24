<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Cart;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // वेबसाइटको सबै ब्लेड फाइलहरूमा $cartCount पठाइदिने कम्पोजर
        View::composer('*', function ($view) {
            $count = 0;

            if (Auth::check()) {
                // १. यदि युजर लगइन छ भने डेटाबेसको 'cart_items' बाट कुल परिमाण (Quantity) जोड्ने
                $userCart = Cart::where('user_id', Auth::id())->first();
                if ($userCart) {
                    // यहाँ sum('quantity') गर्दा आइटमका संख्याहरू (जस्तै: २ वटा जुत्ता + १ शर्ट = ३) जोडिन्छन्।
                    // यदि केवल छुट्टाछुट्टै आइटम मात्र गन्ने हो भने count() प्रयोग गर्न सक्नुहुन्छ।
                    $count = CartItem::where('cart_id', $userCart->id)->sum('quantity');
                }
            } else {
                // २. यदि युजर लगइन छैन र सेसन प्रयोग गरिएको छ भने (Guest Cart को लागि सुरक्षित साइड)
                $cart = session()->get('cart', []);
                foreach ($cart as $item) {
                    $count += $item['quantity'] ?? 1;
                }
            }

            // भ्यारिएबल शेयर गरेको
            $view->with('cartCount', $count);
        });
    }
}