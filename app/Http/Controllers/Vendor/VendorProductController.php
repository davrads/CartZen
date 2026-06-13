<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{
    public function index()
    {
        $vendor = auth()->user()->vendor;
        $products = Product::where('vendor_id', $vendor->id)->latest()->paginate(10);
        return view('vendor.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('vendor.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $vendor = auth()->user()->vendor;
        $data = $request->all();
        $data['slug'] = Str::slug($request->name) . '-' . uniqid();
        $data['vendor_id'] = $vendor->id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        Product::create($data);
        return redirect()->route('vendor.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $this->authorizeVendor($product);
        $categories = Category::all();
        return view('vendor.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeVendor($product);
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = '/storage/' . $path;
        }
        $product->fill($request->only('name', 'category_id', 'price', 'stock', 'description', 'is_active'));
        $product->save();

        return redirect()->route('vendor.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeVendor($product);
        $product->delete();
        return redirect()->route('vendor.products.index')->with('success', 'Product deleted.');
    }

    private function authorizeVendor(Product $product)
    {
        if ($product->vendor_id !== auth()->user()->vendor->id) {
            abort(403);
        }
    }
}