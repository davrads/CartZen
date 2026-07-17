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
                'product',
                'product.category',
                'product.vendor',
            ])
            ->orderBy('end_date')
            ->take(6)
            ->get();

       

        // Featured Products
        $featuredProducts = Product::featured()
            ->where('status', 'available')
            ->take(8)
            ->get();

        $justForYouProducts = Product::where('status', 'available')
            ->latest()
            ->take(12)
            ->get();

        // Categories
        $categories = Category::whereNull('parent_id')
            ->take(8)
            ->get();

        // Approved Vendors
        $topStores = VendorProfile::where('status', 'approved')
            ->take(6)
            ->get();

        return view('frontend.home', compact(
            'flashSales',
            'featuredProducts',
            'categories',
            'topStores',
            'justForYouProducts'
        ));
    }

    public function shop(Request $request)
    {
        $query = Product::query();

        // Optional: only products currently in flash sale
        if ($request->boolean('flash')) {
            $query->whereHas('flashSale', function ($q) {
                $q->active();
            });
        }

        $products = $query->paginate(12);

        $categories = Category::all();

        return view('frontend.shop', compact(
            'products',
            'categories'
        ));
    }

    public function productShow($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('frontend.product', compact('product'));
    }

    public function vendorStore($id)
    {
        $vendor = VendorProfile::findOrFail($id);

        $products = Product::where('vendor_id', $vendor->user_id)
            ->paginate(12);

        return view('frontend.vendor-store', compact(
            'vendor',
            'products'
        ));
    }
}
