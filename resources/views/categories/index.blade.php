@extends('layouts.app')

@section('content')
<div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-blue-500 to-pink-500 animate-gradient-shift"></div>

    <div class="absolute inset-0 opacity-10">
        <img src="https://loremflickr.com/80/80/headphones?random=1" class="floating-item w-16 h-16 absolute top-20 left-[10%]" alt="">
        <img src="https://loremflickr.com/80/80/shoe?random=2" class="floating-item w-20 h-20 absolute top-40 right-[15%]" alt="">
        <img src="https://loremflickr.com/80/80/watch?random=3" class="floating-item w-14 h-14 absolute bottom-32 left-[20%]" alt="">
        <img src="https://loremflickr.com/80/80/laptop?random=4" class="floating-item w-24 h-24 absolute top-1/3 right-[25%]" alt="">
        <img src="https://loremflickr.com/80/80/bag?random=5" class="floating-item w-16 h-16 absolute bottom-20 right-[10%]" alt="">
        <img src="https://loremflickr.com/80/80/shirt?random=6" class="floating-item w-18 h-18 absolute top-2/3 left-[30%]" alt="">
    </div>
</div>

<style>
    @keyframes gradient-shift {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .animate-gradient-shift {
        background-size: 200% 200%;
        animation: gradient-shift 8s ease infinite;
    }

    @keyframes float {
        0%   { transform: translateY(0px) rotate(0deg); }
        50%  { transform: translateY(-15px) rotate(5deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }
    .floating-item {
        animation: float 6s ease-in-out infinite;
        filter: brightness(0) invert(1);
        opacity: 0.6;
    }
    .floating-item:nth-child(odd)  { animation-duration: 7s; }
    .floating-item:nth-child(even) { animation-duration: 5s; }
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
        <div class="flex flex-col lg:flex-row gap-6">
            <div class="lg:w-64 flex-shrink-0 space-y-4">
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">All Categories</h2>
                    <div class="space-y-0.5">
                        @foreach($categories as $cat)
                            <a href="{{ route('categories.show', $cat) }}"
                               class="block px-3 py-2 text-sm font-medium rounded-lg transition
                                      {{ $cat->id === $category->id
                                          ? 'bg-violet-50 text-violet-700'
                                          : 'text-gray-600 hover:bg-gray-50 hover:text-violet-600' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Price Filter --}}
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Price</h2>
                    <div class="space-y-3">
                        @php $prices = ['0-10K', '10-20K', '20-30K', '30-40K', '40-50K', 'Above 50K']; @endphp
                        @foreach($prices as $price)
                            <label class="flex items-center gap-3 cursor-pointer text-sm text-gray-700 hover:text-violet-600 transition">
                                <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-violet-600 focus:ring-violet-500">
                                {{ $price }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Main Product Area --}}
            <div class="flex-1 min-w-0">
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
                    {{-- Header --}}
                    <div class="px-6 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100">
                        <div>
                            <h1 class="text-2xl font-extrabold text-gray-800">{{ $category->name }}</h1>
                            <p class="text-sm text-gray-500 mt-1">
                                Showing {{ $products->firstItem() }} – {{ $products->lastItem() }} of {{ $products->total() }} products
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">Sort by:</span>
                            <select class="border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
                                <option>Popular</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    {{-- Product Grid --}}
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                            {{ $products->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection