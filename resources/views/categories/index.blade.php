@extends('layouts.app')

@section('content')


<style>
    @keyframes gradient-shift {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .animate-gradient-shift {
        background-size: 200% 200%;
        animation: gradient-shift 8s ease infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-15px) rotate(5deg);
        }

        100% {
            transform: translateY(0px) rotate(0deg);
        }
    }

    .floating-item {
        animation: float 6s ease-in-out infinite;
        filter: brightness(0) invert(1);
        opacity: 0.6;
    }

    .floating-item:nth-child(odd) {
        animation-duration: 7s;
    }

    .floating-item:nth-child(even) {
        animation-duration: 5s;
    }
</style>

<div class="min-h-screen">
    @if(isset($category))
    <div class="max-w-7xl mx-auto px-4 pt-4 pb-2 text-sm text-gray-200">
        <a href="{{ url('/') }}" class="hover:text-white transition">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('categories.index') }}" class="hover:text-white transition">Categories</a>
        <span class="mx-2">/</span>
        <span class="font-medium text-white">{{ $category->name }}</span>
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 py-6">
        <form id="filter-form" action="{{ isset($category) ? route('categories.show', $category) : route('categories.index') }}" method="GET">
            <div class="flex flex-col lg:flex-row gap-6">

                {{-- Mobile Filter Toggle Button (Visible only on mobile) --}}
                <div class="lg:hidden mb-2">
                    <button type="button" id="mobile-filter-btn" class="w-full flex items-center justify-center gap-2 bg-violet-600 text-white px-4 py-3 rounded-xl font-semibold shadow-sm hover:bg-violet-700 transition">
                        <i class="fas fa-sliders-h"></i>
                        Filters & Categories
                    </button>
                </div>

                {{-- Sidebar (Sticky on Desktop, Hidden/Modal on Mobile) --}}
                <div id="mobile-sidebar" class="hidden lg:block lg:w-64 lg:sticky lg:top-24 self-start flex-shrink-0 space-y-4 transition-all duration-300">

                    <!-- Categories -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">All Categories</h2>
                        <div class="space-y-0.5 max-h-64 overflow-y-auto custom-scrollbar">
                            @foreach($categories as $cat)
                            <a href="{{ route('categories.show', $cat) }}"
                                class="block px-3 py-2 text-sm font-medium rounded-lg transition
                                      {{ isset($category) && $cat->id === $category->id
                                          ? 'bg-violet-50 text-violet-700'
                                          : 'text-gray-600 hover:bg-gray-50 hover:text-violet-600' }}">
                                {{ $cat->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Price</h2>
                        <div class="space-y-3">
                            @php
                            $prices = [
                            '0-10000' => '0-10K',
                            '10000-20000' => '10-20K',
                            '20000-30000' => '20-30K',
                            '30000-40000' => '30-40K',
                            '40000-50000' => '40-50K',
                            '50000-above' => 'Above 50K'
                            ];
                            $selectedPrices = (array) request('prices', []);
                            @endphp
                            @foreach($prices as $key => $label)
                            <label class="flex items-center gap-3 cursor-pointer text-sm text-gray-700 hover:text-violet-600 transition">
                                <input type="checkbox"
                                    name="prices[]"
                                    value="{{ $key }}"
                                    class="price-checkbox w-4 h-4 rounded border-gray-300 text-violet-600 focus:ring-violet-500"
                                    {{ in_array($key, $selectedPrices) ? 'checked' : '' }}
                                    onchange="document.getElementById('filter-form').submit()">
                                {{ $label }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Main Product Area --}}
                <div class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
                        {{-- Header --}}
                        <div class="px-4 sm:px-6 py-4 sm:py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100">
                            <div>
                                <!-- Category Name: Falls back to 'All Products' if not set -->
                                <h1 class="text-xl sm:text-2xl font-extrabold text-gray-800 truncate">
                                    {{ isset($category) ? $category->name : 'All Products' }}
                                </h1>

                                <!-- Product Count: Smaller text on mobile -->
                                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                                    Showing {{ $products->firstItem() ?? 0 }} – {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
                                </p>
                            </div>

                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <span class="text-xs sm:text-sm text-gray-500 whitespace-nowrap">Sort by:</span>
                                <select name="sort"
                                    onchange="document.getElementById('filter-form').submit()"
                                    class="w-full sm:w-auto border border-gray-300 rounded-xl px-3 sm:px-4 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 bg-white">
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                            </div>
                        </div>

                        {{-- Product Grid --}}
                        <div class="p-4 sm:p-6">
                            <div class="grid grid-cols-2 gap-3 sm:gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                                @forelse($products as $product)
                                <x-product-card :product="$product" />
                                @empty
                                <div class="col-span-full py-16 text-center text-gray-400">
                                    <i class="fas fa-box-open text-4xl mb-3"></i>
                                    <p class="text-lg">No products found in this category.</p>
                                </div>
                                @endforelse
                            </div>

                            @if($products->hasPages())
                            <div class="mt-8 flex justify-center">
                                {{ $products->appends(request()->query())->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Mobile Toggle Script --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btn = document.getElementById('mobile-filter-btn');
                const sidebar = document.getElementById('mobile-sidebar');

                if (btn && sidebar) {
                    btn.addEventListener('click', function() {
                        // Toggle the hidden class
                        sidebar.classList.toggle('hidden');

                        // Change button icon/text to indicate state
                        const icon = btn.querySelector('i');
                        const text = btn;

                        if (sidebar.classList.contains('hidden')) {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-sliders-h');
                            text.innerHTML = '<i class="fas fa-sliders-h"></i> Filters & Categories';
                        } else {
                            icon.classList.remove('fa-sliders-h');
                            icon.classList.add('fa-times');
                            text.innerHTML = '<i class="fas fa-times"></i> Close Filters';
                        }
                    });
                }
            });
        </script>
    </div>
</div>
@endsection