<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\VendorProfile;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        // Active Flash Sales
        $flashSales = FlashSale::active()
            ->with([
                'product' => function ($query) {
                    $query->approved();
                },
                'product.category',
                'product.vendor',
            ])
            ->whereHas('product', function ($query) {
                $query->approved();
            })
            ->orderBy('end_date')
            ->take(6)
            ->get();



        // Featured Products
        // $featuredProducts = Product::featured()
        //     ->where('status', 'available')
        //     ->take(8)
        //     ->get();

        $justForYouProducts = Product::approved()
            ->latest()
            ->take(18)
            ->get();

        // Categories
        $categories = Category::whereNull('parent_id')
            ->take(8)
            ->get();

        // Approved Vendors
        $stores = VendorProfile::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.home', compact(
            'flashSales',
            // 'featuredProducts',
            'categories',
            'stores',
            'justForYouProducts'
        ));
    }

    public function shopOnSale(Request $request)
    {
        $flashSales = FlashSale::with([
            'product' => function ($query) {
                $query->approved();
            },
            'product.category',
            'product.flashSale',
        ])
            ->whereHas('product', function ($query) {
                $query->approved();
            })
            ->active()          // Local scope on FlashSale model
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('frontend.shop', compact(
            'flashSales',
            'categories'
        ));
    }

    public function productShow($slug)
    {
        $product = Product::approved()
        ->where('slug', $slug)
        ->firstOrFail();

        return view('frontend.product', compact('product'));
    }

    public function vendorStore($id)
    {
        $vendor = VendorProfile::findOrFail($id);

        $products = Product::approved()->where('vendor_id', $vendor->user_id)
            ->paginate(12);

        return view('frontend.vendor-store', compact(
            'vendor',
            'products'
        ));
    }
}
