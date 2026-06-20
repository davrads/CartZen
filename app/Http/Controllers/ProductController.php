<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load([
            'images',
            'variants',
            'category',
            'vendor',
        ]);
        return view('products.show', compact('product'));
    }
}
