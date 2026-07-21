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

        // 1. Query builder तयार गर्ने
        $query = Product::query();

        // Price Filter
        if ($request->has('prices') && is_array($request->prices)) {
            $query->where(function ($q) use ($request) {
                foreach ($request->prices as $range) {
                    if ($range === '50000-above') {
                        $q->orWhere('price', '>=', 50000);
                    } else {
                        $parts = explode('-', $range);
                        if (count($parts) === 2) {
                            $q->orWhereBetween('price', [(float)$parts[0], (float)$parts[1]]);
                        }
                    }
                }
            });
        }

        // Sorting Logic
        if ($request->sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort == 'featured') {
            $query->orderByDesc('featured');
        } else {
            $query->latest();
        }

        // 2. Query execute गरेर pagination गर्ने
        $products = $query->paginate(9);

        return view('categories.index', compact(
            'category',
            'categories',
            'products'
        ));
    }

    public function show(Category $category, Request $request)
    {
        $categories = Category::all();

        // Category अनुसारको Product Query
        $query = $category->products();

        // Price Filter
        if ($request->has('prices') && is_array($request->prices)) {
            $query->where(function ($q) use ($request) {
                foreach ($request->prices as $range) {
                    if ($range === '50000-above') {
                        $q->orWhere('price', '>=', 50000);
                    } else {
                        $parts = explode('-', $range);
                        if (count($parts) === 2) {
                            $q->orWhereBetween('price', [(float)$parts[0], (float)$parts[1]]);
                        }
                    }
                }
            });
        }

        // Sorting Logic
        if ($request->sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort == 'featured') {
            $query->orderByDesc('featured');
        } else {
            $query->latest();
        }

        $products = $query->paginate(9);

        return view('categories.index', compact('category', 'categories', 'products'));
    }
}