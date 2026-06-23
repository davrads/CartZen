<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Product $products)
    {
        $categories = Category::all();

        $featuredProducts = Product::where('featured', 1)
            ->latest()
            ->take(8)
            ->get();

        $products = Product::where('featured', false)
            ->latest()
            ->paginate(19);

        return view('frontend.home', compact(
            'products',
            'categories',
            'featuredProducts'
        ));
    }
}
