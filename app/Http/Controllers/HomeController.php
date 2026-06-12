<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Flash deals: active products with is_flash_deal = 1 and not expired
        $flashDeals = Product::where('is_flash_deal', true)
            ->where('flash_deal_ends_at', '>', now())
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)->get();

        return view('home', compact('flashDeals', 'featuredProducts', 'categories'));
    }
}