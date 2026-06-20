<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::all();
        $products = Product::with('images')->get();

        return view('frontend.categories.index', compact(
            'categories',
            'products'));

    }
}
