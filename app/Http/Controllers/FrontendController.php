<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\VendorProfile;

class FrontendController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::latest()->take(8)->get();
        $categories = Category::all();
        $vendors = VendorProfile::latest()->take(6)->get();
        return view('frontend.home', compact('featuredProducts', 'categories', 'vendors'));
    }

    public function shop()
    {
        $products = Product::paginate(12);
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
        $products = Product::where('vendor_id', $id)->paginate(12);
        return view('frontend.vendor-store', compact('vendor', 'products'));
    }
}