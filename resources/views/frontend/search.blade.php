@extends('layouts.app')

@section('title', 'Search Results for "' . $query . '" - CartZen')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Search Heading --}}
    <div class="mb-6">
        <h1 class="text-2xl sm:text-2xl font-bold text-gray-900">
            Search Results for <span class="text-violet-600 font-extrabold">"{{ $query }}"</span>
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Found {{ $products->total() }} {{ Str::plural('item', $products->total()) }}
        </p>
    </div>

    {{-- Product Grid --}}
    @if($products->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
            @foreach($products as $product)
                <div class="flex flex-col h-full">
                    {{-- Component प्रयोग गरिएको छ भने --}}
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        {{-- Pagination Links --}}
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        {{-- No Products Found --}}
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm my-6">
            <div class="w-20 h-20 bg-violet-50 text-violet-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No products found</h3>
            <p class="text-gray-500 max-w-md mx-auto mb-6">
                We couldn't find any items matching "<span class="font-medium text-gray-700">{{ $query }}</span>". Try checking for spelling errors or using more general terms.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-violet-600 text-white font-medium rounded-xl hover:bg-violet-700 transition shadow-lg shadow-violet-200">
                Back to Home
            </a>
        </div>
    @endif

</div>
@endsection