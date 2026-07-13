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
                    Showing {{ $products->count() }} of {{ $products->total() }} products
                </p>
            </div>
            
            <div class="w-full md:w-auto min-w-[200px]">
                <form method="GET" action="{{ route('shop') }}" id="sortForm">
                    <div class="relative">
                        <select name="sort" class="w-full bg-white border border-gray-300 text-gray-700 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm cursor-pointer shadow-sm appearance-none" onchange="document.getElementById('sortForm').submit();">
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Sort by Popularity</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @if(request('flash'))
                        <input type="hidden" name="flash" value="{{ request('flash') }}">
                    @endif
                </form>
            </div>
        </div>

        <div class="flex-1">
            @if($products && $products->count() > 0)
               
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach($products as $product)
                        {{-- Pass the entire product object to the component --}}
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-200">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-box-open text-6xl text-gray-200"></i>
                    </div>
                    <h3 class="text-gray-900 font-medium text-xl">No products found</h3>
                    <p class="text-gray-500 text-sm mt-2 max-w-md mx-auto">
                        We couldn't find any products matching your current criteria. Please try a different category or filter.
                    </p>
                    <a href="{{ route('home') }}" class="inline-block mt-6 px-6 py-3 bg-purple-600 text-white rounded-xl font-medium hover:bg-purple-700 transition-colors">
                        Back to Home
                    </a>
                </div>
            @endif
        </div>

        @if($products && $products->count() > 0)
        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>
        @endif

    </div>
</div>
@endsection