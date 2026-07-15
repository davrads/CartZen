@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<style>
    body {
        font-family: 'DM Sans', sans-serif;
    }

    .order-id {
        font-family: 'DM Mono', monospace;
    }

    .sidebar-link {
        transition: background 0.18s, color 0.18s;
        cursor: pointer;
    }

    .sidebar-active {
        background: #EDE9FE;
        color: #6D28D9;
        font-weight: 600;
    }

    .sidebar-inactive {
        color: #6B7280;
    }

    .sidebar-inactive:hover {
        background: #F5F3FF;
        color: #6D28D9;
    }

    .tab-active {
        border-bottom: 2.5px solid #7C3AED;
        color: #7C3AED;
        font-weight: 600;
    }

    .tab-inactive {
        border-bottom: 2.5px solid transparent;
        color: #6B7280;
    }

    .tab-inactive:hover {
        color: #7C3AED;
        border-color: #DDD6FE;
    }

    .badge {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        padding: 3px 12px;
        border-radius: 999px;
    }

    .badge-delivered {
        background: #D1FAE5;
        color: #065F46;
    }

    .badge-shipped {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .badge-processing {
        background: #FEF3C7;
        color: #92400E;
    }

    .badge-pending {
        background: #E0F2FE;
        color: #0369A1;
    }

    .badge-cancelled {
        background: #FEE2E2;
        color: #991B1B;
    }

    .order-row {
        transition: box-shadow 0.18s, background 0.18s;
    }

    .order-row:hover {
        background: #F5F3FF;
        box-shadow: 0 2px 16px 0 #7c3aed18;
    }

    #sidebar-overlay {
        display: none;
    }

    #sidebar-overlay.show {
        display: block;
    }

    .page {
        display: none;
    }

    .page.active {
        display: block;
    }

    input,
    textarea,
    select {
        outline: none;
    }

    .tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #EDE9FE;
        color: #6D28D9;
        border-radius: 999px;
        padding: 3px 10px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .notif-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #7C3AED;
        display: inline-block;
    }

    .toggle {
        position: relative;
        width: 40px;
        height: 22px;
    }

    .toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #D1D5DB;
        border-radius: 999px;
        transition: .3s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 3px;
        bottom: 3px;
        background: white;
        border-radius: 50%;
        transition: .3s;
    }

    input:checked+.slider {
        background: #7C3AED;
    }

    input:checked+.slider:before {
        transform: translateX(18px);
    }

    .wishlist-card:hover .remove-btn {
        opacity: 1;
    }

    .remove-btn {
        opacity: 0;
        transition: opacity 0.2s;
    }

    .star {
        color: #FCD34D;
    }

    .star.empty {
        color: #D1D5DB;
    }
</style>

<link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap"
    rel="stylesheet" />

<div class="bg-gray-50 min-h-screen text-gray-800">
    <header
        class="lg:hidden fixed top-0 left-0 right-0 z-30 bg-white shadow-sm flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-2">
            <button id="menu-btn" onclick="openSidebar()"
                class="p-2 rounded-lg text-violet-600 hover:bg-violet-50 transition">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>
        </div>
        <div class="relative">
            <input type="text" placeholder="Search…"
                class="text-sm border border-gray-200 rounded-full py-1.5 pl-3 pr-8 w-36 focus:border-violet-400 focus:ring-1 focus:ring-violet-200 bg-gray-50" />
            <button class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-violet-600 rounded-full p-1">
                <svg width="12" height="12" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
            </button>
        </div>
    </header>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/30 lg:hidden" onclick="closeSidebar()"></div>

    <div class="bg-white grid lg:grid-cols-[auto,1fr]">
        <aside id="sidebar"
            class="fixed lg:static top-0 left-0 h-screen lg:h-[calc(100vh-5rem)] overflow-y-auto w-64 bg-white shadow-xl z-50 flex flex-col transition-transform duration-300 -translate-x-full lg:translate-x-0 lg:shadow-none lg:border-r lg:border-gray-100">

            <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100 shrink-0">
                <div
                    class="w-11 h-11 rounded-full bg-violet-600 flex items-center justify-center text-white font-bold text-lg shrink-0">
                    {{ strtoupper(substr(Auth::guard('customer')->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="font-semibold text-gray-900 text-sm truncate">{{ Auth::guard('customer')->user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::guard('customer')->user()->email }}</p>
                </div>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
                <button type="button" onclick="navigate('profile')" data-nav="profile"
                    class="sidebar-link sidebar-inactive w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.7"
                        viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    My Profile
                </button>
                <button type="button" onclick="navigate('address')" data-nav="address"
                    class="sidebar-link sidebar-inactive w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.7"
                        viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Address Book
                </button>
                <button type="button" onclick="navigate('orders')" data-nav="orders"
                    class="sidebar-link sidebar-active w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.7"
                        viewBox="0 0 24 24">
                        <rect x="2" y="3" width="20" height="14" rx="2" />
                        <line x1="8" y1="21" x2="16" y2="21" />
                        <line x1="12" y1="17" x2="12" y2="21" />
                    </svg>
                    My Orders
                </button>
                <button type="button" onclick="navigate('wishlist')" data-nav="wishlist"
                    class="sidebar-link sidebar-inactive w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.7"
                        viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                    Wishlist
                </button>
                <button type="button" onclick="navigate('reviews')" data-nav="reviews"
                    class="sidebar-link sidebar-inactive w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.7"
                        viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                    Reviews
                </button>
                <button type="button" onclick="navigate('notifications')" data-nav="notifications"
                    class="sidebar-link sidebar-inactive w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.7"
                        viewBox="0 0 24 24">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                    Notifications
                    @if(isset($notifications) && count($notifications) > 0)
                        <span class="ml-auto bg-violet-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                            {{ count($notifications->where('read_at', null)) }}
                        </span>
                    @endif
                </button>
                <button type="button" onclick="navigate('settings')" data-nav="settings"
                    class="sidebar-link sidebar-inactive w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.7"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="3" />
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
                    </svg>
                    Settings
                </button>
            </nav>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center gap-3 px-6 py-2.5 rounded-xl text-sm hover:bg-red-50 hover:text-red-600 transition">
                    Logout
                </button>
            </form>
        </aside>

        <div class="lg:ml-0 min-h-screen flex flex-col">
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 mt-14 lg:mt-0">

                <div id="page-profile" class="page">
                    <h1 class="text-xl font-bold text-gray-900 mb-6">My Profile</h1>
                    <div class="max-w-2xl">
                        @if(session('success'))
                            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-xl">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-xl">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-16 h-16 rounded-full bg-violet-600 flex items-center justify-center text-white font-bold text-2xl shrink-0">
                                        {{ strtoupper(substr(Auth::guard('customer')->user()->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-lg">{{ Auth::guard('customer')->user()->name }}</p>
                                        <p class="text-sm text-gray-400">Member since {{ Auth::guard('customer')->user()->created_at->format('M Y') }}</p>
                                    </div>
                                    <button type="button" class="ml-auto text-sm text-violet-600 font-medium hover:underline">Change Photo</button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="sm:col-span-2">
                                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name', Auth::guard('customer')->user()->name) }}"
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition" required />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email', Auth::guard('customer')->user()->email) }}"
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition" required />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">Phone Number</label>
                                        <input type="tel" name="phone" value="{{ old('phone', Auth::guard('customer')->user()->phone ?? (Auth::guard('customer')->user()->addresses->where('is_default', 1)->first()->phone ?? (Auth::guard('customer')->user()->addresses->first()->phone ?? ''))) }}"
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition" />
                                    </div>
                                </div>
                                <button type="submit" class="mt-5 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">Save Changes</button>
                            </form>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('PUT')
                                <h2 class="font-bold text-gray-800 mb-4 text-base">Change Password</h2>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">Current Password</label>
                                        <input type="password" name="current_password" placeholder="••••••••"
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition" required />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">New Password</label>
                                        <input type="password" name="password" placeholder="••••••••"
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition" required />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" placeholder="••••••••"
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 transition" required />
                                    </div>
                                </div>
                                <button type="submit" class="mt-4 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="page-address" class="page">
                    <h1 class="text-xl font-bold text-gray-900 mb-6">Address Book</h1>
                    <div class="max-w-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-sm text-gray-500">Your saved addresses</p>
                            <button onclick="openAddressForm()"
                                class="flex items-center gap-1.5 text-sm font-semibold text-violet-600 hover:text-violet-800 transition">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Add New Address
                            </button>
                        </div>

                        <div id="add-address-form" class="hidden bg-violet-50 border border-violet-200 rounded-2xl p-5 mb-4">
                            <form id="addressForm" method="POST" action="{{ route('addresses.store') }}">
                                @csrf
                                <div id="method-field"></div> <h3 id="form-title" class="font-semibold text-gray-800 text-sm mb-3">New Address</h3>
                               <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="adr_full_name" class="block text-xs font-semibold text-gray-500 mb-1.5">Full Name</label>
                                        <input type="text" name="full_name" id="adr_full_name" placeholder="Full Name" required
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 bg-white transition" />
                                    </div>

                                    <div>
                                        <label for="adr_phone" class="block text-xs font-semibold text-gray-500 mb-1.5">Phone Number</label>
                                        <input type="tel" name="phone" id="adr_phone" placeholder="Phone Number" required
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 bg-white transition" />
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="adr_province" class="block text-xs font-semibold text-gray-500 mb-1.5">Province</label>
                                        <input type="text" name="province" id="adr_province" placeholder="Province" required
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 bg-white transition" />
                                    </div>

                                    <div>
                                        <label for="adr_district" class="block text-xs font-semibold text-gray-500 mb-1.5">District</label>
                                        <input type="text" name="district" id="adr_district" placeholder="District" required
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 bg-white transition" />
                                    </div>

                                    <div>
                                        <label for="adr_city" class="block text-xs font-semibold text-gray-500 mb-1.5">City</label>
                                        <input type="text" name="city" id="adr_city" placeholder="City" required
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 bg-white transition" />
                                    </div>

                                    <div>
                                        <label for="adr_address_line" class="block text-xs font-semibold text-gray-500 mb-1.5">Address Line</label>
                                        <input type="text" name="address_line" id="adr_address_line" placeholder="Address Line" required
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 bg-white transition" />
                                    </div>

                                    <div>
                                        <label for="adr_postal_code" class="block text-xs font-semibold text-gray-500 mb-1.5">Postal Code</label>
                                        <input type="text" name="postal_code" id="adr_postal_code" placeholder="Postal Code" required
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-100 bg-white transition" />
                                    </div>

                                    <div class="sm:col-span-2 flex items-center gap-2 mt-2">
                                        <input type="checkbox" name="is_default" id="is_default" value="1" 
                                            class="rounded text-violet-600 focus:ring-violet-500 w-4 h-4 cursor-pointer">
                                        <label for="is_default" class="text-xs font-medium text-gray-600 cursor-pointer select-none">Set as default address</label>
                                    </div>
                                </div>
                                <div class="flex gap-2 mt-3">
                                    <button type="submit" class="bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition">Save</button>
                                    <button type="button" onclick="document.getElementById('add-address-form').classList.add('hidden')"
                                        class="text-sm font-medium text-gray-500 hover:text-gray-700 px-4 py-2 rounded-xl border border-gray-200 bg-white transition">Cancel</button>
                                </div>
                            </form>
                        </div>

                        <div class="space-y-4">
                            @forelse(Auth::guard('customer')->user()->addresses ?? [] as $address)
                                <div class="bg-white rounded-2xl shadow-sm {{ $address->is_default ? 'border-2 border-violet-400' : 'border border-gray-100' }} p-5">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                @if($address->is_default)
                                                    <span class="tag">Default</span>
                                                @endif
                                                <span class="tag">Saved</span>
                                            </div>
                                            <p class="font-semibold text-gray-800 text-sm mt-2">{{ $address->full_name }}</p>
                                            <p class="text-sm text-gray-500 mt-0.5">{{ $address->province }}, {{ $address->district }}, {{ $address->city }}, {{ $address->address_line }}</p>
                                            <p class="text-sm text-gray-400 mt-1">{{ $address->phone }}</p>
                                        </div>
                                        <div class="flex gap-2 shrink-0 ml-3">
                                            <button onclick="editAddress({{ $address->toJson() }})" class="text-xs text-violet-600 hover:underline font-medium"><i class=" text-lg fa-solid fa-pen-to-square"></i></button>
                                            <form method="POST" action="{{ route('addresses.destroy', $address->id) }}" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-400 hover:underline font-medium">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-400 bg-white rounded-2xl border border-gray-100">
                                    <p class="text-sm">No saved addresses found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div id="page-orders" class="page active">
                    <h1 class="text-xl font-bold text-gray-900 mb-4">My Orders</h1>
                    <div class="flex gap-0 border-b border-gray-200 mb-5 overflow-x-auto">
                        <button onclick="setTab(this,'all')" data-tab="all" class="tab-active px-4 sm:px-5 py-2.5 text-sm whitespace-nowrap transition">All</button>
                        <button onclick="setTab(this,'pending')" data-tab="pending" class="tab-inactive px-4 sm:px-5 py-2.5 text-sm whitespace-nowrap transition">Pending</button>
                        <button onclick="setTab(this,'processing')" data-tab="processing" class="tab-inactive px-4 sm:px-5 py-2.5 text-sm whitespace-nowrap transition">Processing</button>
                        <button onclick="setTab(this,'shipped')" data-tab="shipped" class="tab-inactive px-4 sm:px-5 py-2.5 text-sm whitespace-nowrap transition">Shipped</button>
                        <button onclick="setTab(this,'delivered')" data-tab="delivered" class="tab-inactive px-4 sm:px-5 py-2.5 text-sm whitespace-nowrap transition">Delivered</button>
                        <button onclick="setTab(this,'cancelled')" data-tab="cancelled" class="tab-inactive px-4 sm:px-5 py-2.5 text-sm whitespace-nowrap transition">Cancelled</button>
                    </div>
                    <div id="orders-list" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden divide-y divide-gray-100">
                        @if(isset($orders) && count($orders) > 0)
                            @foreach($orders as $order)
                                <div class="order-row flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 sm:px-6 py-4 sm:py-5" data-status="{{ $order->status }}">
                                    <div>
                                        <p class="order-id font-medium text-gray-800 text-sm">Order #{{ $order->order_number }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="flex items-center gap-3 sm:gap-5 flex-wrap">
                                        <span class="font-semibold text-gray-800 text-sm sm:text-base">Rs. {{ number_format($order->total_amount) }}</span>
                                        <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                                        <a href="#" class="text-violet-600 hover:text-violet-800 text-sm font-medium hover:underline transition">View Details</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div id="empty-state" class="py-16 text-center text-gray-400">
                                <svg class="mx-auto mb-3 w-12 h-12 text-gray-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <rect x="2" y="3" width="20" height="14" rx="2" />
                                    <line x1="8" y1="21" x2="16" y2="21" />
                                    <line x1="12" y1="17" x2="12" y2="21" />
                                </svg>
                                <p class="text-sm">No orders found</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div id="page-wishlist" class="page">
                    <h1 class="text-xl font-bold text-gray-900 mb-6">Wishlist</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        
                        @forelse($wishlistItems ?? [] as $id => $item)
                            <div class="wishlist-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
                                <div class="relative bg-gray-50 h-44 flex items-center justify-center">
                                    @if(isset($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="object-cover h-full w-full">
                                    @else
                                        <svg width="64" height="64" fill="none" stroke="#D1D5DB" stroke-width="1" viewBox="0 0 24 24">
                                            <rect x="3" y="3" width="18" height="18" rx="2" />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <polyline points="21 15 16 10 5 21" />
                                        </svg>
                                    @endif
                                    
                                    <a href="{{ route('wishlist.remove', $id) }}" class="remove-btn absolute top-2 right-2 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow text-red-400 hover:text-red-600 hover:shadow-md transition">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <line x1="18" y1="6" x2="6" y2="18" />
                                            <line x1="6" y1="6" x2="18" y2="18" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="p-4">
                                    <p class="font-semibold text-gray-800 text-sm">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Quantity: {{ $item['quantity'] }}</p>
                                    <div class="flex items-center justify-between mt-3">
                                        <span class="font-bold text-gray-900">Rs. {{ number_format($item['price']) }}</span>
                                        <a href="{{ route('wishlist.toCart', $id) }}" class="bg-violet-600 hover:bg-violet-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition inline-block text-center">
                                            Add to Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-400 bg-white rounded-2xl border border-gray-100">
                                <p class="text-sm">Wishlist मा कुनै पनि सामान छैन ।</p>
                            </div>
                        @endforelse

                    </div>
                </div>

                <div id="page-reviews" class="page">
                    <h1 class="text-xl font-bold text-gray-900 mb-6">Reviews</h1>
                    <div class="max-w-2xl space-y-4">
                        @forelse($reviews ?? [] as $review)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center shrink-0 overflow-hidden">
                                        @if(isset($review->product) && $review->product->image)
                                            <img src="{{ asset('storage/' . $review->product->image) }}" alt="Product" class="object-cover w-full h-full">
                                        @else
                                            <svg width="24" height="24" fill="none" stroke="#9CA3AF" stroke-width="1" viewBox="0 0 24 24">
                                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                <polyline points="21 15 16 10 5 21" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between flex-wrap gap-2">
                                            <p class="font-semibold text-gray-800 text-sm">{{ $review->product->name ?? 'Product Name' }}</p>
                                            <span class="text-xs text-gray-400">{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex gap-0.5 mt-1 mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="star text-base {{ $i <= $review->rating ? '' : 'empty' }}">★</span>
                                            @endfor
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $review->comment }}</p>
                                        <div class="flex gap-3 mt-3">
                                            <button onclick="editReview({{ $review->id }})" class="text-xs text-violet-600 hover:underline font-medium">Edit</button>
                                            <form method="POST" action="{{ route('reviews.destroy', $review->id) }}" onsubmit="return confirm('Are you sure you want to delete this review?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-400 hover:underline font-medium">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-400 bg-white rounded-2xl border border-gray-100">
                                <p class="text-sm">तपाईंले अहिलेसम्म कुनै पनि Review लेख्नुभएको छैन।</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div id="page-notifications" class="page">
                    <h1 class="text-xl font-bold text-gray-900 mb-6">Notifications</h1>
                    <div class="max-w-2xl space-y-3">
                        @forelse($notifications ?? [] as $notification)
                            <div class="bg-violet-50 border border-violet-100 rounded-2xl p-4 flex items-start gap-3 relative">
                                @if(is_null($notification->read_at))
                                    <span class="notif-dot mt-1.5 shrink-0"></span>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $notification->data['message'] ?? '' }}</p>
                                    <p class="text-xs text-violet-400 mt-1.5 font-medium">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-gray-600 transition shrink-0">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <line x1="18" y1="6" x2="6" y2="18" />
                                            <line x1="6" y1="6" x2="18" y2="18" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-400 bg-white rounded-2xl border border-gray-100">
                                <p class="text-sm">कुनै पनि नयाँ सूचना (Notification) छैन।</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div id="page-settings" class="page">
                    <h1 class="text-xl font-bold text-gray-900 mb-6">Settings</h1>
                    <div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
                        <div>
                            <h3 class="font-bold text-gray-800 text-base mb-3">Email Preferences</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Order Updates</p>
                                        <p class="text-xs text-gray-400">Receive emails regarding purchase confirmation.</p>
                                    </div>
                                    <label class="toggle"><input type="checkbox" checked><span class="slider"></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</div>

<script>
    function navigate(pageId) {
        document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
        const targetPage = document.getElementById(`page-${pageId}`);
        if (targetPage) targetPage.classList.add('active');

        document.querySelectorAll('[data-nav]').forEach(btn => {
            if (btn.getAttribute('data-nav') === pageId) {
                btn.classList.remove('sidebar-inactive');
                btn.classList.add('sidebar-active');
            } else {
                btn.classList.remove('sidebar-active');
                btn.classList.add('sidebar-inactive');
            }
        });
        closeSidebar();
    }

    function setTab(element, status) {
        element.parentElement.querySelectorAll('button').forEach(btn => {
            btn.classList.remove('tab-active');
            btn.classList.add('tab-inactive');
        });
        element.classList.remove('tab-inactive');
        element.classList.add('tab-active');

        let rowsFound = false;
        document.querySelectorAll('.order-row').forEach(row => {
            if (status === 'all' || row.getAttribute('data-status') === status) {
                row.style.display = 'flex';
                rowsFound = true;
            } else {
                row.style.display = 'none';
            }
        });
        document.querySelectorAll('#empty-state').forEach(el => {
            el.style.display = rowsFound ? 'none' : 'block';
        });
    }

    function openSidebar() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.add('show');
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.remove('show');
    }

    function openAddressForm() {
        const formContainer = document.getElementById('add-address-form');
        const form = document.getElementById('addressForm');
        
        document.getElementById('form-title').innerText = "New Address";
        document.getElementById('method-field').innerHTML = "";
        form.action = "{{ route('addresses.store') }}";
        form.reset();
        
        formContainer.classList.remove('hidden');
    }

    function editAddress(address) {
        const formContainer = document.getElementById('add-address-form');
        const form = document.getElementById('addressForm');
        
        document.getElementById('form-title').innerText = "Edit Address";
        document.getElementById('method-field').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        form.action = `/addresses/${address.id}`;
        
        document.getElementById('adr_full_name').value = address.full_name;
        document.getElementById('adr_phone').value = address.phone;
        document.getElementById('adr_province').value = address.province;
        document.getElementById('adr_district').value = address.district;
        document.getElementById('adr_city').value = address.city;
        document.getElementById('adr_address_line').value = address.address_line; 
        document.getElementById('adr_postal_code').value = address.postal_code;
        document.getElementById('is_default').checked = address.is_default == 1;
        
        formContainer.classList.remove('hidden');
        formContainer.scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection