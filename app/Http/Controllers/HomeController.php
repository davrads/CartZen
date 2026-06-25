<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->take(8)
            ->get();

        $featuredProducts = Product::where('featured', '=', 1, 'and')
            ->latest()
            ->take(8)
            ->get();

        $products = Product::where('featured', '=', false, 'and')
            ->latest()
            ->paginate(19);

        $flashSales = FlashSale::active()
            ->with('product.category', 'product.vendor')
            ->get();

        return view('frontend.home', compact(
            'flashSales',
            'featuredProducts',
            'categories',
            'products',
            
        ));
    }
}
