<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\VendorProfile;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        // Active flash deals: is_flash_deal = true and end_date > now
        $flashProducts = Product::activeFlashDeal()
            ->orderBy('flash_deal_ends_at', 'asc')
            ->take(12)
            ->get();

        // Featured products (existing logic)
        $featuredProducts = Product::where('featured', true)
            ->where('status', 'available')
            ->take(8)
            ->get();

        // Categories (top‑level)
        $categories = Category::whereNull('parent_id')
            ->take(8)
            ->get();

        // Approved vendor profiles
        $topStores = VendorProfile::where('status', 'approved')
            ->take(6)
            ->get();

        return view('frontend.home', compact(
            'flashProducts',
            'featuredProducts',
            'categories',
            'topStores'
        ));
    }

    public function shop(Request $request)
    {
        $query = Product::query();

        // Optional: filter by flash deal
        if ($request->has('flash') && $request->flash == 1) {
            $query->activeFlashDeal();
        }

        $products = $query->paginate(12, ['*'], 'page', $request->input('page'));
        $categories = Category::all();

        return view('frontend.shop', compact('products', 'categories'));
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
            ->paginate(12, ['*'], 'page', request()->input('page'));
        return view('frontend.vendor-store', compact('vendor', 'products'));
    }
}