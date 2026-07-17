@extends('layouts.app')

@section('title', 'All Products - CartZen')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">All Products</h1>
        <p class="text-gray-500 mt-2">Browse our complete collection</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
        @forelse($allProducts as $product)
            <div class="flex flex-col h-full">
                <x-product-card :product="$product" />
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                <p class="text-gray-500 mt-1">Check back later for new arrivals!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        {{ $allProducts->links() }}
    </div>

</div>
@endsection