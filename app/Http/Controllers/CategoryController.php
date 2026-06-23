<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category, Request $request)
    {
        $categories = Category::all();
        $products = Product::latest()->paginate(9);

 if ($request->sort == 'featured') {
        $products->orderByDesc('featured');
    }
        return view('categories.index', compact(
            'category',
            'categories',
            'products'
        ));
    }
    public function show(Category $category, Request $request){

    

        $categories = Category::all();
        $products =$category->products()->latest()->paginate(9);

        return view('categories.index', compact('category','categories', 'products'));

    }
}
