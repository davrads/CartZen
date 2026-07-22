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

        // Category Filtering
        if ($request->filled('category')) {
            $query->whereIn('category_id', (array) $request->category);
        }

        // Brand Filtering
        if ($request->filled('brand')) {
            $query->whereIn('brand', (array) $request->brand);
        }

        // Price Filtering
        if ($request->filled('min_price')) {
            $query->whereRaw('COALESCE(sale_price, price) >= ?', [$request->min_price]);
        }

        if ($request->filled('max_price')) {
            $query->whereRaw('COALESCE(sale_price, price) <= ?', [$request->max_price]);
        }

        // Flash Sale (On Sale) Filter
        if ($request->boolean('on_sale')) {
            $query->whereHas('flashSale', function ($q) {
                $q->where('is_active', true)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            });
        }

        // Stock Status Filter (In Stock Only)
        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Dynamic Sorting Logic for Index Page
        switch ($request->get('sort_by')) {
            case 'price_low_high':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'price_high_low':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'popular':
                $query->orderBy('sold_count', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            default:
                $query->latest();
                break;
        }

        $categories = Category::orderBy('name', 'asc')->get();

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

        $allProducts = $query->paginate(12)->withQueryString();

        return view('products.index', compact(
            'allProducts',
            'flashSales',
            'categories',
            'brands'
        ));
    }

    public function show(Request $request, Product $product)
    {
        $product->load([
            'images',
            'variants',
            'category',
            'flashSale'
        ]);

        // Related Products Query Construction
        $relatedQuery = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'available')
            ->with('flashSale');

        // 1. Dynamic Price Filter for Related Products
        if ($request->filled('max_price')) {
            $relatedQuery->whereRaw('COALESCE(sale_price, price) <= ?', [$request->max_price]);
        }

        if ($request->filled('min_price')) {
            $relatedQuery->whereRaw('COALESCE(sale_price, price) >= ?', [$request->min_price]);
        }

        // 2. Stock Filter for Related Products
        if ($request->boolean('in_stock')) {
            $relatedQuery->where('stock', '>', 0);
        }

        // 3. Dynamic Sort By for Related Products
        switch ($request->get('sort_by')) {
            case 'price_low_high':
                $relatedQuery->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'price_high_low':
                $relatedQuery->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'popular':
                $relatedQuery->orderBy('sold_count', 'desc');
                break;
            case 'latest':
                $relatedQuery->latest();
                break;
            default:
                $relatedQuery->inRandomOrder(); // Default: Random Order
                break;
        }

        $relatedProducts = $relatedQuery->take(10)->get();

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