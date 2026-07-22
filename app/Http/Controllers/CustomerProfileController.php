<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerProfileController extends Controller
{
    /**
     * Update Customer Profile Information
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::guard('customer')->user();

        // Validation Rules
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('customers', 'email')->ignore($user->id), // table name 'customers' नभए 'users' राख्नुहोस्
            ],
            'phone' => 'nullable|string|max:20',
        ]);

        // Update Name and Email
        $user->name  = $request->name;
        $user->email = $request->email;

        // यदि customer table मा phone column छ भने:
        if (\Schema::hasColumn($user->getTable(), 'phone')) {
            $user->phone = $request->phone;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile information updated successfully!');
    }

    /**
     * Update Customer Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = Auth::guard('customer')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided current password does not match.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}