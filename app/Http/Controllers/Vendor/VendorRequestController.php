<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorApplication;
use Illuminate\Http\Request;

class VendorRequestController extends Controller
{
    public function create()
    {
        return view('vendor.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'owner_name' => 'required|max:255',
            'shop_name' => 'required|max:255',
            'email' => 'required|email|unique:vendor_profiles,email',
            'phone' => 'required',
            'address' => 'required',
            'description' => 'required',
            'shop_logo' => 'required|image|max:2048',
            'pan_card' => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $logo = $request
            ->file('shop_logo')
            ->store('vendor/logo', 'public');

        $pan = $request
            ->file('pan_card')
            ->store('vendor/pan', 'public');

        VendorApplication::create([
            'owner_name' => $request->owner_name,
            'shop_name' => $request->shop_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'shop_logo' => $logo,
            'pan_card' => $pan,
        ]);

        return redirect()->route('vendor.submitted');
    }

    public function submitted()
    {
        return view('vendor.submitted');
    }
}
