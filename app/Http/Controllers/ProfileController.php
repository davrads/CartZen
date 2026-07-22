<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Models\Order;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // Guard बाट customer तान्ने
        $user = Auth::guard('customer')->user() ?? $request->user();

        // Validation Rules
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Table name यदि 'customers' हो भने 'customers' राख्नुहोस्
            ],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->fill([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Database मा phone column छ भने मात्र fill गर्ने
        if (\Schema::hasColumn($user->getTable(), 'phone')) {
            $user->phone = $request->phone;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::back()->with('status', 'profile-updated')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's password.
     */
    public function passwordUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::guard('customer')->user() ?? $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return Redirect::back()->withErrors(['current_password' => 'The provided current password does not match.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return Redirect::back()->with('success', 'Password updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::guard('customer')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    /**
     * Display customer order profile page
     */
    public function profile()
    {
        // लगइन भएको customer को मात्र अर्डरहरू तान्न (user_id को आधारमा)
        // यहाँ Auth::guard('customer')->user()->id को प्रयोग गरिएको छ
        $orders = Order::where('user_id', Auth::guard('customer')->user()->id)
                       ->latest()
                       ->get();

        // compact('orders') गरेर डाटा भ्युमा पठाउने
        return view('user_profile', compact('orders'));
    }
}