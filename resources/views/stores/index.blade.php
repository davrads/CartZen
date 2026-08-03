@extends('layouts.app')

@section('title', 'Our Stores')

@section('content')

<!-- Hero Section -->
<!-- Using max-w-7xl mx-auto px-4 to match navbar -->
<section class="bg-gradient-to-r from-violet-700 via-violet-600 to-indigo-700 text-white py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 text-center">

        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 tracking-tight">
            Explore Our Stores
        </h1>

        <p class="text-violet-100 max-w-2xl mx-auto mb-8 text-sm sm:text-base leading-relaxed">
            Discover trusted vendors from across Nepal offering quality products in various categories.
        </p>


        <form class="max-w-xl mx-auto relative" action="{{ route('stores.index') }}" method="GET">
            <div class="relative group">
                <!-- Search Input -->
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search stores by name or location..."
                    class="w-full rounded-full border border-gray-300 bg-white px-6 py-3.5 pr-20 text-gray-700 shadow-sm placeholder:text-gray-400 focus:border-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-200 transition-all text-center">

                <!-- Search Button -->
                <button
                    type="submit"
                    class="absolute right-1.5 top-1.5 bottom-1.5 bg-violet-600 hover:bg-violet-700 text-white px-4 py-1.5 rounded-full font-medium text-sm transition-colors flex items-center gap-2 shadow-sm">
                    <i class="fas fa-search text-sm"></i>
                    <!-- Text hidden on small screens, visible on sm+ -->
                    <span class="hidden sm:inline">Search</span>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Marketplace Stats -->
<section class="py-10 bg-white border-b border-gray-100">
    <!-- Using max-w-7xl mx-auto px-4 to match navbar -->
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">

            <div class="text-center p-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-violet-100 text-violet-700 mb-3">
                    <i class="fas fa-store text-xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-violet-700">
                    {{ $stores->total() }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Verified Stores</p>
            </div>

            <div class="text-center p-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-700 mb-3">
                    <i class="fas fa-box text-xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-violet-700">
                    {{ $totalProducts }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Products</p>
            </div>

            <div class="text-center p-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 text-green-700 mb-3">
                    <i class="fas fa-tags text-xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-violet-700">
                    {{ $categories }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Categories</p>
            </div>

            <div class="text-center p-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-orange-100 text-orange-700 mb-3">
                    <i class="fas fa-star text-xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-violet-700">
                    {{ $totalReviews }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Reviews</p>
            </div>

        </div>
    </div>
</section>

<!-- Store Listing -->
<section class="py-12 sm:py-16 bg-gray-50">
    <!-- Using max-w-7xl mx-auto px-4 to match navbar -->
    <div class="max-w-7xl mx-auto px-4">

        <!-- Header & Sort -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 sm:mb-10 gap-4">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                Our Stores
            </h2>


        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @forelse($stores as $store)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">

                <!-- Image Area -->
                <div class="relative h-48 overflow-hidden bg-gray-100">
                    <img
                        src="{{ asset('storage/'.$store->shop_logo ) }}"
                        alt="{{ $store->store_name }}"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    >
                    <!-- Verified Badge -->
                    <div class="absolute top-3 right-3 bg-green-500 text-white text-[10px] sm:text-xs font-bold px-2.5 py-1 rounded-full shadow-md flex items-center gap-1">
                        <i class="fas fa-check-circle text-[8px]"></i>
                        Verified
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-1">
                        {{ $store->store_name }}
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-500 line-clamp-2 mb-4 flex-1">
                        {{ $store->description }}
                    </p>

                    <!-- Details -->
                    <div class="space-y-2 text-xs sm:text-sm text-gray-600 border-t border-gray-100 pt-4 mt-auto">
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-1.5 text-gray-500"><i class="fas fa-box-open text-violet-500"></i> Products</span>
                            <span class="font-semibold text-gray-900">{{ $store->products_count }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-1.5 text-gray-500"><i class="fas fa-map-marker-alt text-violet-500"></i> Location</span>
                            <span class="font-medium text-gray-900">{{ $store->district }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-1.5 text-gray-500"><i class="fas fa-calendar-alt text-violet-500"></i> Joined</span>
                            <span class="font-medium text-gray-900">{{ $store->created_at->format('M Y') }}</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a
                        href="{{ route('stores.show', $store) }}"
                        class="mt-5 block w-full text-center bg-violet-600 hover:bg-violet-700 text-white py-2.5 rounded-xl font-semibold text-sm transition-colors shadow-sm">
                        Visit Store
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 sm:py-20 bg-white rounded-2xl border border-dashed border-gray-200">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-violet-50 mb-4 text-violet-600">
                    <i class="fas fa-store text-3xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">
                    No Stores Found
                </h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    Try searching with another keyword or check back later for new arrivals.
                </p>
            </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $stores->links() }}
        </div>

    </div>
</section>

@endsection