<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function update(Request $request, Address $address)
{
    // सुरक्षा जाँच: जसको ठेगाना हो उसैले मात्र सच्याउन पाओस्
    if ($address->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    $validated = $request->validate([
        'full_name'   => 'required|string|max:255',
        'phone'       => 'required|string|max:20',
        'province'    => 'required|string|max:255',
        'district'    => 'required|string|max:255',
        'city'        => 'required|string|max:255',
        'address_line'    => 'required|string|max:255',
        'postal_code' => 'required|string|max:20',
        
    ]);

    if ($request->has('is_default')) {
        Address::where('user_id', Auth::id())->update(['is_default' => false]);
    }

    $address->update([
        'full_name'   => $validated['full_name'],
        'phone'       => $validated['phone'],
        'province'    => $validated['province'],
        'district'    => $validated['district'],
        'city'        => $validated['city'],
        'address_line'     => $validated['address_line'],
        'postal_code' => $validated['postal_code'],
        
        'is_default'  => $request->has('is_default') ? true : false,
    ]);

    return redirect()->back()->with('success', 'Address updated successfully!');
}    public function destroy(Address $address)
    {
        
        if ($address->user_id === Auth::id()) {
            $address->delete();
            return redirect()->back()->with('success', 'Address deleted successfully!');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
}