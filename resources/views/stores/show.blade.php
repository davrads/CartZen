@extends('layouts.app')

@section('content')

<style>
    /* Custom scrollbar for sidebar */
    .sidebar-scroll {
        scrollbar-width: thin;
        scrollbar-color: #e5e7eb transparent;
    }

    .sidebar-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background-color: #e5e7eb;
        border-radius: 20px;
    }

    /* Checkbox styling */
    .filter-checkbox:checked+span {
        color: #4f46e5;
        font-weight: 500;
    }

    .filter-checkbox:checked {
        border-color: #4f46e5;
        background-color: #4f46e5;
    }

    /* Mobile drawer state classes */
    .drawer-closed {
        transform: translateX(100%);
        pointer-events: none;
    }

    .drawer-open {
        transform: translateX(0);
        pointer-events: auto;
    }

    /* Backdrop transition */
    #mobile-filter-backdrop {
        transition: opacity 0.3s ease-in-out;
    }

    /* Drawer transition */
    #mobile-filter-drawer>div:last-child {
        transition: transform 0.3s ease-in-out;
    }
</style>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <!-- STORE HEADER -->
        <header class="bg-gradient-to-r from-violet-700 via-violet-600 to-indigo-700 rounded-xl shadow-sm border border-gray-200 p-6 mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4 w-full md:w-auto">
                <div class="w-24 h-24 bg-violet-100 rounded-2xl shadow-lg flex items-center justify-center shrink-0 overflow-hidden  border-4 border-white">
                    <img src="{{ asset('storage/'.$vendorProfile->shop_logo ) }}" alt="{{ $vendorProfile->shop_name }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $vendorProfile->shop_name }}</h1>
                    @if($vendorProfile->status == 'approved')
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        ✓ Verified Seller
                    </span>
                    @endif
                    <p class=" text-violet-100 max-w-md mt-2 leading-relaxed">
                        {{ $vendorProfile->description }}
                    </p>
                    <div class="flex items-center gap-2 text-xs text-violet-100 mt-1">
                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                        {{ $vendorProfile->address }}
                    </div>
                </div>
            </div>

            <!-- Product Count Badge -->
            <div class="flex flex-col items-center md:items-end">
                <div class="flex flex-wrap gap-4 mt-4">
                    <div class="bg-white/20 backdrop-blur-md rounded-xl w-28 h-24 flex flex-col justify-center items-center shadow-md border border-white/20">
                        <span class="text-2xl font-bold text-white">{{ $productCount }}</span>
                        <span class="text-xs text-violet-100 uppercase">Products</span>
                    </div>
                    <div class="bg-white/20 backdrop-blur-md rounded-xl w-28 h-24 flex flex-col justify-center items-center shadow-md border border-white/20">
                        <span class="text-2xl font-bold text-white">{{ $brandCount }}</span>
                        <span class="text-xs text-violet-100 uppercase">Brands</span>
                    </div>
                    <div class="bg-white/20 backdrop-blur-md rounded-xl w-28 h-24 flex flex-col justify-center items-center shadow-md border border-white/20">
                        <span class="text-2xl font-bold text-white">{{ $featuredCount }}</span>
                        <span class="text-xs text-violet-100 uppercase">Featured</span>
                    </div>
                    <div class="bg-white/20 backdrop-blur-md rounded-xl w-28 h-24 flex flex-col justify-center items-center shadow-md border border-white/20">
                        <span class="text-2xl font-bold text-white">{{ $flashCount }}</span>
                        <span class="text-xs text-violet-100 uppercase">Flash Sale</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Header with Filter Toggle -->
        <div class="lg:hidden flex justify-between items-center mb-6 sticky top-0 bg-gray-50 z-20 py-2">
            <h2 class="text-lg font-bold text-gray-900">Browse Products</h2>
            <div class="flex gap-2">
                <button id="mobile-filter-btn" class="flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 active:bg-gray-100" onclick="toggleMobileFilters()">
                    <i class="fas fa-filter text-violet-600"></i> Filters
                </button>
                <button class="flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                    <i class="fas fa-sort"></i> Sort
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Desktop Sidebar (Hidden on Mobile) -->
            <aside class="hidden lg:block w-72 shrink-0 bg-white border border-gray-200 rounded-xl p-6 h-fit shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-gray-900">Filters</h2>
                    <a href="{{ route('stores.show', $vendorProfile) }}" class="text-xs text-violet-600 hover:text-violet-800 font-medium">Reset</a>
                </div>
                <form action="{{ route('stores.show', $vendorProfile) }}" method="GET">
                    <!-- Brand -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-building text-gray-400"></i> Brand
                        </h3>
                        <div class="space-y-2">
                            @foreach ($brands as $brand)
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="brand[]" value="{{ $brand }}"
                                    @checked(in_array($brand, request('brand', [])))
                                    class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-violet-600">{{ $brand}}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Variants -->
                    <div class="mb-6 border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-palette text-gray-400"></i> Colors
                        </h3>
                        <div class="space-y-2">
                            @foreach($colors as $color)
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="color[]" value="{{ $color }}"
                                    @checked(in_array($color, request('color', [])))
                                    class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-violet-600">{{ ucfirst($color) }}</span>
                            </label>
                            @endforeach
                        </div>
                        <div class="space-y-2 mt-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-ruler-combined text-gray-400"></i> Sizes
                            </h3>
                            @foreach($sizes as $size)
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="size[]" value="{{ $size }}"
                                    @checked(in_array($size, request('size', [])))
                                    class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-violet-600">{{ ucfirst($size) }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6 border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-tag text-gray-400"></i> Price Range
                        </h3>
                        <div class="flex items-center gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                            <span class="text-gray-400 text-sm">-</span>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        </div>
                        <button type="submit" class="mt-4 w-full bg-violet-600 text-white py-2 rounded text-sm font-medium hover:bg-violet-700 transition">Apply Filters</button>
                    </div>
                </form>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 min-w-0">
                <!-- Desktop Header -->
                <div class="hidden lg:flex justify-between items-center mb-6 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">All Products</h2>
                        <p class="text-gray-500 text-sm mt-1">Showing {{ $products->total() }} results</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600">Sort by:</span>
                        <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-violet-500 text-sm bg-white">
                            <option>Popular</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest</option>
                        </select>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                    <x-product-card :product="$product" />
                    @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-xl border border-gray-200">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                            <i class="fas fa-box-open text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">No products found</h3>
                        <p class="text-gray-500 text-sm">Try adjusting your filters or search criteria.</p>
                    </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
</div>

<!-- Mobile Filter Drawer (Overlay) -->
<div id="mobile-filter-drawer" class="fixed inset-0 z-50 lg:hidden drawer-closed overflow-hidden">
    <!-- Backdrop -->
    <div id="mobile-filter-backdrop" class="absolute inset-0 bg-black bg-opacity-50 transition-opacity opacity-0" onclick="toggleMobileFilters()"></div>

    <!-- Drawer Content -->
    <div class="absolute right-0 top-0 h-full w-full max-w-xs bg-white shadow-xl flex flex-col transform transition-transform duration-300 ease-out">
        <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-bold text-gray-900">Filters</h2>
            <button onclick="toggleMobileFilters()" class="text-gray-500 hover:text-gray-700 p-2">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form action="{{ route('stores.show', $vendorProfile) }}" method="GET">
            <div class="flex-1 overflow-y-auto p-4 space-y-6 sidebar-scroll">
                <!-- Brand -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Brand</h3>
                    <div class="space-y-2">
                        @foreach ($brands as $brand)
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="brand[]" value="{{ $brand }}"
                                @checked(in_array($brand, request('brand', [])))
                                class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                            <span class="ml-3 text-gray-700">{{ $brand }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Colors -->
                <div class="border-t border-gray-100 pt-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Colors</h3>
                    <div class="space-y-2">
                        @foreach($colors as $color)
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="color[]" value="{{ $color }}"
                                @checked(in_array($color, request('color', [])))
                                class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                            <span class="ml-3 text-gray-700">{{ ucfirst($color) }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Sizes -->
                <div class="border-t border-gray-100 pt-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Sizes</h3>
                    <div class="space-y-2">
                        @foreach($sizes as $size)
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="size[]" value="{{ $size }}"
                                @checked(in_array($size, request('size', [])))
                                class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                            <span class="ml-3 text-gray-700">{{ ucfirst($size) }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range -->
                <div class="border-t border-gray-100 pt-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Price Range</h3>
                    <div class="flex items-center gap-2">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        <span class="text-gray-400">-</span>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="p-4 border-t border-gray-200 bg-gray-50 flex gap-3">
                <button type="button" onclick="toggleMobileFilters()" class="flex-1 bg-white border border-gray-300 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="submit" class="flex-1 bg-violet-600 text-white py-3 rounded-lg font-medium hover:bg-violet-700 transition shadow-lg shadow-violet-200">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.toggleMobileFilters = function() {
        const drawer = document.getElementById('mobile-filter-drawer');
        const backdrop = document.getElementById('mobile-filter-backdrop');
        const drawerContent = drawer.querySelector('div:last-child'); // The white content box

        if (!drawer || !backdrop) {
            console.error("Filter elements not found. Check IDs.");
            return;
        }

        const isOpen = !drawer.classList.contains('drawer-closed');

        if (isOpen) {
            // Close
            drawer.classList.remove('drawer-open');
            drawer.classList.add('drawer-closed');
            drawerContent.classList.remove('translate-x-0');
            drawerContent.classList.add('translate-x-full');

            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');

            // Reset button style if needed
            const btn = document.getElementById('mobile-filter-btn');
            if (btn) {
                btn.classList.remove('bg-violet-600', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            }
        } else {
            drawer.classList.remove('drawer-closed');
            drawer.classList.add('drawer-open');
            drawerContent.classList.remove('translate-x-full');
            drawerContent.classList.add('translate-x-0');

            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');

            const btn = document.getElementById('mobile-filter-btn');
            if (btn) {
                btn.classList.remove('bg-white', 'text-gray-700');
                btn.classList.add('bg-violet-600', 'text-white');
            }
        }
    };

    // Optional: Add keyboard support (Escape key to close)
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            const drawer = document.getElementById('mobile-filter-drawer');
            if (drawer && !drawer.classList.contains('drawer-closed')) {
                window.toggleMobileFilters();
            }
        }
    });
</script>

@endsection