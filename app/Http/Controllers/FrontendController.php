<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\VendorProfile;
use App\Models\FlashSale;

class FrontendController extends Controller
{
    public function home()
{
    $flashSales = FlashSale::active()->with('product')->get();
    $featuredProducts = Product::where('featured', true)->where('status', 'available')->take(8)->get();
    $categories = Category::whereNull('parent_id')->take(8)->get();
    $topStores = VendorProfile::where('status', 'approved')->take(6)->get();

    return view('frontend.home', compact('flashSales', 'featuredProducts', 'categories', 'topStores'));
}

    public function shop()
    {
        // Use the standard paginate signature: paginate(perPage, columns, pageName, page)
        $products = Product::paginate(12, ['*'], 'page', request()->input('page'));
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
        $products = Product::where('vendor_id', $id)->paginate(12, ['*'], 'page', request()->input('page'));
        return view('frontend.vendor-store', compact('vendor', 'products'));
    }
}