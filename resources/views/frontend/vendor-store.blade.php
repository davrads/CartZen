@extends('layouts.app')
@section('content')

<style>
    .category-main-block-section {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
    }
</style>

<body class="bg-gray-50 min-h-screen py-4 sm:py-8 px-4">

<section class="category-main-block">
    <div class="flex min-h-screen flex-col lg:flex-row">

        <!-- Mobile Filter Buttons -->
        <div class="lg:hidden mb-4 flex justify-between items-center sticky top-0 z-10 bg-gray-50 py-2">
            <button class="flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                <i class="fas fa-filter"></i> Filters
            </button>
            <button class="flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                <i class="fas fa-sort"></i> Sort
            </button>
        </div>

        <!-- Sidebar (Desktop Only) -->
        <div class="w-72 bg-white border-r border-gray-200 p-6 hidden lg:block shrink-0">
            <h2 class="text-xl font-semibold mb-6">Categories</h2>
            <div class="space-y-3 mb-8">
                <div class="text-gray-700 cursor-pointer hover:text-violet-600 font-medium">All Products</div>
                <div class="text-gray-700 cursor-pointer hover:text-violet-600">Headphones</div>
                <div class="text-gray-700 cursor-pointer hover:text-violet-600">Speakers</div>
                <div class="text-gray-700 cursor-pointer hover:text-violet-600">Smartwatches</div>
                <div class="text-gray-700 cursor-pointer hover:text-violet-600">Accessories</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 w-full">
            
            <!-- Header -->
            <div class="bg-white border-b px-6 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold">All Products</h1>
                    <p class="text-gray-500 text-sm">{{ count($products ?? []) }} products</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600 hidden sm:inline">Sort by:</span>
                    <select class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-violet-500 text-sm">
                        <option>Popular</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    @forelse($products ?? [] as $product)
                        <!-- Using the Component -->
                        <x-product-card :product="$product" />
                    @empty
                        <div class="col-span-full text-center py-12">
                            <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">No products found.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>

</body>
@endsection