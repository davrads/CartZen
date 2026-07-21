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
            ->with(['category', 'flashSale'])
            ->latest()
            ->paginate(12);

        return view('products.index', compact('allProducts', 'flashSales'));
    }

    public function show(Product $product)
    {
        $product->load([
            'images',
            'variants',
            'category',
            'flashSale'
        ]);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'available')
            ->limit(6)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = trim($request->input('query'));

        // Query खाली छ भने सिधै खाली नतिजा वा पछाडि फर्काउने
        if (empty($query)) {
            $products = Product::where('id', 0)->paginate(12);
            return view('search', compact('products', 'query'));
        }

        // 'available' भएका सामानहरूमा मात्र Grouped Query मार्फत सर्च गर्ने
        $products = Product::where('status', 'available')
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('brand', 'LIKE', "%{$query}%");
            })
            ->with(['category', 'flashSale']) // Eager Loading (N+1 Problem रोक्न)
            ->latest()
            ->paginate(12)
            ->appends(['query' => $query]); // Pagination पेज पल्टाउँदा Search Word हराउँदैन

        return view('frontend.search', compact('products', 'query'));
    }
}