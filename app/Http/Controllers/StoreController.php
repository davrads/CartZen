<?php

namespace App\Http\Controllers;

use App\Models\VendorProfile;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = VendorProfile::paginate(6);
        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorProfile $vendorProfile, Request $request)
    {



        $stores = VendorProfile::all();
        $query = $vendorProfile
            ->user
            ->products()
            ->latest();

        //Brand Request Filtering
        if ($request->filled('brand')) {
            $query->whereIn('brand', $request->brand);
        }

        //Price Request Filtering
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $brands = $vendorProfile->user->products()
            ->whereNotNull('brand')
            ->pluck('brand')
            ->unique();

        // Color Request Filtering
        if ($request->filled('color')) {

            $query->whereHas('variants', function ($q) use ($request) {

                $q->whereIn('color', $request->color);
            });
        }

        $colors = $vendorProfile->user->products()
            ->with('variants')
            ->get()
            ->pluck('variants')
            ->flatten()
            ->pluck('color')
            ->filter()
            ->unique()
            ->values();

        //        Size Request Filtering
        if ($request->filled('size')) {

            $query->whereHas('variants', function ($q) use ($request) {

                $q->whereIn('size', $request->size);
            });
        }

        $sizes = $vendorProfile->user->products()
            ->with('variants')
            ->get()
            ->pluck('variants')
            ->flatten()
            ->pluck('size')
            ->filter()
            ->unique()
            ->values();

        $products = $query
            ->paginate(6)
            ->withQueryString();

        $productCount = $vendorProfile->user->products()->count();

        $brandCount = $vendorProfile->user
            ->products()
            ->distinct('brand')
            ->count('brand');

        $featuredCount = $vendorProfile->user
            ->products()
            ->where('featured', true)
            ->count();

        $flashCount = $vendorProfile->user
            ->products()
            ->whereHas('flashSale',function ($query) {
                $query->where('is_active',true)
                    ->where('start_date','<=',now())
                    ->where('end_date','>=',now());
            })
            ->count();


        return view('stores.show', [
            'vendorProfile' => $vendorProfile,
            'products' => $products,
            'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes,
            'productCount' => $productCount,
            'brandCount' => $brandCount,
            'featuredCount' => $featuredCount,
            'flashCount' => $flashCount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
