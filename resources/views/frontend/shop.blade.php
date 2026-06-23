@extends('layouts.app')

@section('title', $categoryName ?? 'All Products - CartZen')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col">
    
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 flex-grow">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">
                    {{ $categoryName ?? 'All Products' }}
                </h1>
                <p class="text-gray-500 text-sm mt-1">
                    Showing {{ $products->count() ?? 20 }} of {{ $totalProducts ?? 245 }} products
                </p>
            </div>
            
            <div class="w-full md:w-auto min-w-[200px]">
                <div class="relative">
                    <select class="w-full bg-white border border-gray-300 text-gray-700 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm cursor-pointer shadow-sm appearance-none">
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Sort by Popularity</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1">
            @if($products && $products->count() > 0)
               
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach($products as $product)
                        <x-product-card 
                            :image="$product->image"
                            :name="$product->name"
                            :price="$product->price"
                            :original_price="$product->original_price"
                            :discount="$product->discount ?? false"
                            :rating="$product->rating ?? 4"
                            :reviews="$product->reviews_count ?? 0"
                            :url="$product->url ?? '#'"
                        />
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-200">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-box-open text-6xl text-gray-200"></i>
                    </div>
                    <h3 class="text-gray-900 font-medium text-xl">No products found</h3>
                    <p class="text-gray-500 text-sm mt-2 max-w-md mx-auto">
                        We couldn't find any products matching your current category. Please try a different search or category.
                    </p>
                    <a href="{{ route('home') }}" class="inline-block mt-6 px-6 py-3 bg-purple-600 text-white rounded-xl font-medium hover:bg-purple-700 transition-colors">
                        Back to Home
                    </a>
                </div>
            @endif
        </div>

        @if($products && $products->count() > 0)
        <div class="mt-12 flex justify-center">
            <div class="flex items-center gap-2 overflow-x-auto pb-2 px-2 max-w-full">
                <button class="hidden sm:flex items-center justify-center w-10 h-10 border border-gray-300 rounded-xl hover:bg-gray-50 text-gray-600 transition-colors disabled:opacity-50">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <button class="w-10 h-10 bg-purple-600 text-white rounded-xl font-medium shadow-md hover:bg-purple-700 transition-colors">1</button>
                <button class="w-10 h-10 border border-gray-300 text-gray-600 rounded-xl hover:bg-gray-50 transition-colors">2</button>
                <button class="w-10 h-10 border border-gray-300 text-gray-600 rounded-xl hover:bg-gray-50 transition-colors">3</button>
                <button class="w-10 h-10 border border-gray-300 text-gray-600 rounded-xl hover:bg-gray-50 transition-colors">...</button>
                
                <button class="hidden sm:flex items-center justify-center w-10 h-10 border border-gray-300 rounded-xl hover:bg-gray-50 text-gray-600 transition-colors disabled:opacity-50">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection