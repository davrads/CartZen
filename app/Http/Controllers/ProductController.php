<?php

namespace App\Http\Controllers;

use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

public function index()
{
    
    $flashSales = FlashSale::with('product')->latest()->limit(6)->get();


    $allProducts = Product::where('status', 'available')
    ->with(['category','flashSale'])
    ->latest()
    ->paginate(12);

    return view('products.index', compact('allProducts'));
}
    public function show(Product $product)
    {
        $product->load([
            'images',
            'variants',
            'category',
        ]);
        return view('products.show', compact('product'));
    }
}
