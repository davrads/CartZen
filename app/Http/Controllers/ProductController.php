<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $flashSales = FlashSale::with('product')->latest()->get();

        $query = Product::where('status', 'available')
            ->with(['category', 'flashSale']);

        $brandQuery = Product::where('status', 'available')
            ->whereNotNull('brand');

        //Category Filtering
        if ($request->filled('category')) {
            $query->whereIn('category_id', (array) $request->category);
        }

        //Brand Filtering
        if ($request->filled('brand')) {
            $query->whereIn('brand', (array) $request->brand);
        }

        //Price Filtering
        if ($request->filled('min_price')) {
            $query->whereRaw('COALESCE(sale_price, price) >= ?', [$request->min_price]);
        }

        if ($request->filled('max_price')) {
            $query->whereRaw('COALESCE(sale_price, price) <= ?', [$request->max_price]);
        }

        $categories = Category::orderBy(
            'name',
            'asc'
        )
            ->get();

        $brands = collect();

        if ($request->filled('category')) {
            $brands = Product::where('status', 'available')
                ->whereIn('category_id', (array) $request->category)
                ->whereNotNull('brand')
                ->select('brand')
                ->distinct()
                ->orderBy('brand')
                ->pluck('brand');
        }

        if ($request->boolean('on_sale')) {
            $query->whereHas('flashSale', function ($q) {

                $q->where('is_active', true)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            });
        }

        $allProducts = $query->paginate(12)
            ->withQueryString();

        return view('products.index', compact(
            'allProducts',
            'flashSales',
            'categories',
            'brands'
        ));
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
            ->with('flashSale')
            ->inRandomOrder()
            ->take(5)
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
