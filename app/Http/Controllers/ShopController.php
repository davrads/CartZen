<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $categoryName = match($slug) {
            'mobiles-tablets' => 'Mobiles & Tablets',
            'headphones' => 'Headphones & Earbuds',
            'fashion' => 'Fashion & Clothing',
            default => 'All Products'
        };

        return view('category', compact('categoryName'));
    }
}