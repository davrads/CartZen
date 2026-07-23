@extends('layouts.app')

@section('title', 'All Products - CartZen')

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

        /* Mobile drawer transitions */
        .drawer-closed {
            transform: translateX(100%);
            pointer-events: none;
        }

        .drawer-open {
            transform: translateX(0);
            pointer-events: auto;
        }

        #mobile-filter-backdrop {
            transition: opacity 0.3s ease-in-out;
        }

        #mobile-filter-drawer>div {
            transition: transform 0.3s ease-in-out;
        }
    </style>

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-8">

            <!-- Mobile Filter Toggle -->
            <div class="lg:hidden mb-6 sticky top-0 bg-gray-50 z-20 py-2 flex justify-end">
                <button id="mobile-filter-btn" onclick="toggleMobileFilters()"
                    class="flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 active:bg-gray-100">
                    <i class="fas fa-filter text-violet-600"></i> Filters
                </button>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">

                <aside
                    class="hidden lg:block w-64 shrink-0 bg-white border border-gray-200 rounded-xl p-5 shadow-sm sticky top-6 h-[calc(100vh-3rem)] overflow-y-auto sidebar-scroll">

                    <form action="{{ route('products.index') }}" method="GET">
                        @if (request('sort_by'))
                            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                        @endif

                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold text-gray-900">Filters</h2>

                            <a href="{{ route('products.index') }}"
                                class="text-xs text-violet-600 hover:text-violet-800 font-medium">
                                Reset
                            </a>
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <h3
                                class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-th-large text-gray-400"></i>
                                Categories
                            </h3>

                            <div class="space-y-2">
                                @foreach ($categories as $category)
                                    <label class="flex items-center cursor-pointer group">
                                        <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                            @checked(in_array($category->id, (array) request('category', [])))
                                            class="w-4 h-4 text-violet-600 rounded border-gray-300">
                                        <span class="ml-2 text-sm text-gray-600 group-hover:text-violet-600">
                                            {{ $category->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Brands -->
                        @if ($brands->isNotEmpty())
                            <div class="mb-6 border-t border-gray-100 pt-4">
                                <h3
                                    class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-building text-gray-400"></i>
                                    Brands
                                </h3>
                                <div class="space-y-2">
                                    @foreach ($brands as $brand)
                                        <label class="flex items-center cursor-pointer group">
                                            <input type="checkbox" name="brand[]" value="{{ $brand }}"
                                                @checked(in_array($brand, (array) request('brand', [])))
                                                class="w-4 h-4 text-violet-600 rounded border-gray-300">
                                            <span class="ml-2 text-sm text-gray-600 group-hover:text-violet-600">
                                                {{ $brand }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- On Sale -->
                        <div class="mb-6 border-t border-gray-100 pt-4">
                            <h3
                                class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-bolt text-orange-400"></i>
                                Offers
                            </h3>
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="on_sale" value="1" @checked(request('on_sale'))
                                    class="w-4 h-4 text-violet-600 rounded border-gray-300 focus:ring-violet-500">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-violet-600">
                                    On Flash Sale
                                </span>
                            </label>
                        </div>

                        <!-- Price -->
                        <div class="border-t border-gray-100 pt-4">
                            <h3
                                class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-tag text-gray-400"></i>
                                Price Range
                            </h3>
                            <div class="flex items-center gap-2">
                                <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            </div>
                        </div>

                        <button type="submit"
                            class="mt-6 w-full bg-violet-600 hover:bg-violet-700 text-white py-3 rounded-lg font-medium">
                            Apply Filters
                        </button>

                    </form>

                </aside>

                <!-- Main Content Area -->
                <main class="flex-1 min-w-0">

                    <!-- Product Controls (Count & Sort) -->
                    <div
                        class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">All Products</h2>
                            <p class="text-gray-500 text-sm mt-1">Showing <span
                                    class="font-semibold text-gray-900">{{ $allProducts->total() }}</span> results</p>
                        </div>
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <span class="text-sm text-gray-600 hidden sm:inline">Sort by:</span>
                            <select onchange="window.location.href=this.value"
                                class="w-full sm:w-auto border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-violet-500 text-sm bg-white">
                                <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'latest']) }}"
                                    {{ request('sort_by', 'latest') == 'latest' ? 'selected' : '' }}>Popular
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'price_low_high']) }}"
                                    {{ request('sort_by') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'price_high_low']) }}"
                                    {{ request('sort_by') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'oldest']) }}"
                                    {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest Products</option>
                            </select>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($allProducts as $product)
                            <div class="flex flex-col h-full">
                                <x-product-card :product="$product" />
                            </div>
                        @empty
                            <div
                                class="col-span-full py-16 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                                <p class="text-gray-500 mt-1">Check back later for new arrivals!</p>
                                <a href="{{ route('products.index') }}"
                                    class="inline-block mt-4 text-violet-600 hover:underline text-sm font-medium">Clear all
                                    filters</a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        {{ $allProducts->links() }}
                    </div>

                </main>
            </div>
        </div>
    </div>

    <!-- Mobile Filter Drawer -->
    <div id="mobile-filter-drawer" class="fixed inset-0 z-50 lg:hidden translate-x-full transition-transform duration-300">
        <div id="mobile-filter-backdrop"
            class="absolute inset-0 bg-black/50 opacity-0 pointer-events-none transition-opacity"
            onclick="toggleMobileFilters()"></div>

        <div class="flex flex-col h-full bg-white max-w-xs w-full ml-auto shadow-xl relative z-10">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-900">Filters</h2>
                <button onclick="toggleMobileFilters()" class="text-gray-500 hover:text-gray-700 p-2">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col flex-1 overflow-hidden">
                @if (request('sort_by'))
                    <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                @endif

                <div class="flex-1 overflow-y-auto p-4 space-y-6 sidebar-scroll">

                    <!-- Categories -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Categories</h3>
                        <div class="space-y-2">
                            @foreach ($categories as $category)
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                        @checked(in_array($category->id, (array) request('category', [])))
                                        class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                                    <span class="ml-3 text-gray-700">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Brands -->
                    @if ($brands->isNotEmpty())
                        <div class="border-t border-gray-100 pt-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Brands</h3>
                            <div class="space-y-2">
                                @foreach ($brands as $brand)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="brand[]" value="{{ $brand }}"
                                            @checked(in_array($brand, (array) request('brand', [])))
                                            class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                                        <span class="ml-3 text-gray-700">{{ $brand }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- On Sale -->
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Offers</h3>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="on_sale" value="1" @checked(request('on_sale'))
                                class="filter-checkbox w-4 h-4 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                            <span class="ml-3 text-gray-700">On Flash Sale</span>
                        </label>
                    </div>

                    <!-- Price Range -->
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Price Range</h3>
                        <div class="flex items-center gap-2">
                            <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                            <span class="text-gray-400">-</span>
                            <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 border-t border-gray-200 bg-gray-50 flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-violet-600 text-white py-3 rounded-lg font-medium hover:bg-violet-700 transition shadow-lg shadow-violet-200">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mobile Drawer Toggle
        window.toggleMobileFilters = function() {
            const drawer = document.getElementById('mobile-filter-drawer');
            const backdrop = document.getElementById('mobile-filter-backdrop');

            if (!drawer || !backdrop) {
                console.error("Filter elements not found. Check IDs.");
                return;
            }

            const isOpen = drawer.classList.contains('drawer-open');

            if (isOpen) {
                // Close
                drawer.classList.remove('drawer-open');
                drawer.classList.add('drawer-closed');
                backdrop.classList.remove('opacity-50');
                backdrop.classList.add('opacity-0', 'pointer-events-none');
            } else {
                // Open
                drawer.classList.remove('drawer-closed');
                drawer.classList.add('drawer-open');
                backdrop.classList.remove('opacity-0', 'pointer-events-none');
                backdrop.classList.add('opacity-50');
            }
        };

        // Optional: Add keyboard support (Escape key to close)
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                const drawer = document.getElementById('mobile-filter-drawer');
                if (drawer && drawer.classList.contains('drawer-open')) {
                    window.toggleMobileFilters();
                }
            }
        });
    </script>
@endsection
