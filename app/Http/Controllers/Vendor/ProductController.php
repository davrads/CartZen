<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('vendor_id', Auth::user()->vendor->id)->latest()->paginate(10);
        return view('vendor.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('vendor.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'is_flash_deal' => 'boolean',
            'flash_deal_ends_at' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'vendor_id' => Auth::user()->vendor->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'price' => $request->price,
            'compare_price' => $request->compare_price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'is_flash_deal' => $request->has('is_flash_deal'),
            'flash_deal_ends_at' => $request->flash_deal_ends_at,
            'is_active' => true,
        ]);

        return redirect()->route('vendor.products.index')->with('success', 'Product created');
    }

    public function edit(Product $product)
    {
        $this->authorizeVendor($product);
        $categories = Category::where('is_active', true)->get();
        return view('vendor.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeVendor($product);
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($request->only(['name', 'price', 'stock', 'description', 'compare_price', 'is_flash_deal', 'flash_deal_ends_at']));

        return redirect()->route('vendor.products.index')->with('success', 'Product updated');
    }

    private function authorizeVendor(Product $product)
    {
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403);
        }
    }
}