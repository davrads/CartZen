@extends('layouts.app')
@section('content')

<style>
    .category-main-block-section {
        width: 1240px;
        /* Fixed typo: widows -> width */
        margin: 0 auto;
    }
</style>

<body class="bg-gray-50 min-h-screen py-4 sm:py-8 px-4">

    <!-- category page block -->
    <section class="flex category-main-block category-main-block-section">

        <!-- Sidebar Container -->
        <div class="w-64 flex-shrink-0">

            <!-- Categories Section -->
            <div class="bg-white border-r border-gray-200 p-4">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Categories</h2>
                <div class="space-y-1">
                    <!-- All Button -->
                    <button class="w-full text-left px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-violet-600 rounded-md transition-colors flex justify-between items-center group">
                        <span>All</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dynamic Category List -->
                    <div class="pl-4">
                        @foreach($categories as $category)
                        <button class="w-full text-left px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-violet-600 rounded-md transition-colors block">
                            <span>{{ $category->name }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Brand Section -->
            <div class="bg-white border-r border-gray-200 p-4 mt-4">
                <h2 class="text-xl font-bold mb-4">Brand</h2>
                <div class="space-y-3 mb-6">
                    <label class="flex items-center gap-3 cursor-pointer font-bold"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Samsung</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Apple</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Xiaomi</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> OnePlus</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Realme</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Vivo</label>
                </div>
            </div>
        </div>
        <!-- End of Sidebar -->

        <!-- Main Content (Mobiles Section) -->
        <div class="flex-1">
            <div class="bg-white border-b px-6 py-5 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Mobiles & Tablets</h1>
                    <p class="text-gray-500">1200+ products</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600">Sort by:</span>
                    <select class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none">
                        <option>Popular</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <x-product-card :product="$product" />
                    @endforeach

                </div>
            </div>
        </div>
        <!-- End of Main Content -->

    </section>
</body>
@endsection