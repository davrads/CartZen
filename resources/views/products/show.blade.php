@extends('layouts.app')

@section('title', 'Samsung Galaxy A14 - Cartzen')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-4">
    <nav class="text-sm text-gray-500 flex items-center gap-2" aria-label="Breadcrumb">
        
        <a href="{{ url('/') }}" class="hover:text-violet-600 transition-colors">
            Home
        </a>

        <span class="text-gray-400">></span>

        <a href="{{ route('categories.show', $product->category) }}"
            class="hover:text-violet-600 transition-colors">
            {{ $product->category->name }}
        </a>

        <span class="text-gray-400">></span>

        <span class="font-medium text-violet-600">
            {{ $product->name }}
        </span>

    </nav>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 lg:py-10">
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

        <div class="w-full lg:w-2/5 flex-shrink-0">
            <div class="flex flex-col-reverse lg:flex-row gap-4">

                <div class="flex lg:flex-col gap-3 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 scrollbar-hide">
                    @foreach($product->images as $image)
                    <div class="h-16 w-16 lg:h-20 lg:w-20 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-purple-600 cursor-pointer transition-all bg-gray-50">
                        <img class="h-full w-full object-cover"
                            src="{{asset('storage/'.$image->product_image)}}"
                            alt="Thumbnail {{ $loop->index + 1 }}"
                            onclick="document.querySelector('.main-image').src = this.src">
                    </div>
                    @endforeach
                </div>

                <div class="flex-1 min-w-0">
                    <div class="aspect-square w-full rounded-3xl overflow-hidden shadow-xl border border-gray-100 bg-white group">
                        <img id="mainImage" class="h-full w-full object-cover main-image"
                            src="{{asset('storage/'.$product->thumbnail)}}"
                            alt="{{$product->name}}">
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-3/5 flex flex-col gap-6">

            <div>
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">
                        {{$product->name}}
                    </h1>
                </div>

                <div class="flex flex-wrap items-center gap-4 text-sm">
                    <div class="flex items-center text-yellow-400">
                        <span>★★★★☆</span>
                        <span class="ml-2 text-gray-700 font-medium">4.5</span>
                    </div>
                    <span class="text-gray-300 hidden sm:inline">•</span>
                    <span class="text-gray-600">128 Reviews</span>
                    <span class="text-gray-300 hidden sm:inline">•</span>
                    <span class="text-gray-600">2.5k+ Sold</span>
                </div>
            </div>

            <div class="flex items-end gap-3 sm:gap-4 flex-wrap">
                @if($product->discounted_price)
                <span class="text-3xl sm:text-4xl font-bold text-purple-600">
                    Rs. {{ number_format($product->discounted_price, 2) }}
                </span>
                <span class="text-lg sm:text-xl text-gray-400 line-through mb-1">
                    Rs. {{ number_format($product->price, 2) }}
                </span>
                <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full mb-1">
                    SAVE {{ number_format((($product->price - $product->discounted_price) / $product->price) * 100, 0) }}%
                </span>
                @else
                <span class="text-3xl sm:text-4xl font-bold text-purple-600">
                    Rs. {{ number_format($product->price, 2) }}
                </span>
                @endif
            </div>

            <div class="text-sm text-gray-600 space-y-1 bg-gray-50 p-4 rounded-xl">
                <p><span class="font-semibold text-gray-800">Brand:</span> {{ $product->brand }}</p>
                <p><span class="font-semibold text-gray-800">SKU:</span> {{ $product->sku }}</p>
            </div>

            <div>
                @if($product->stock > 0)
                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-sm font-medium px-3 py-1.5 rounded-lg border border-green-100">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    In Stock ({{ $product->stock }} available)
                </span>
                @else
                <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 text-sm font-medium px-3 py-1.5 rounded-lg border border-red-100">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Out of Stock
                </span>
                @endif
            </div>

           

            <div>
                <h3 class="text-sm font-semibold text-gray-800 mb-3">Select Variant</h3>
                <div class="relative">
                    <select name="variant_id"
                        class="w-full appearance-none border border-gray-300 rounded-xl p-3 pr-10 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-shadow cursor-pointer">
                        @foreach($product->variants as $variant)
                        <option value="{{ $variant->id }}">
                            {{ $variant->color }} - {{ $variant->size }} - Rs. {{ number_format($variant->price, 2) }}
                        </option>
                        @endforeach
                    </select>
                    <!-- Custom Arrow Icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-800 mb-3">Quantity</h3>
                <div class="flex items-center w-full sm:w-40 border border-gray-300 rounded-2xl overflow-hidden bg-white">
                    <button type="button" onclick="decreaseQuantity()" class="w-12 h-12 flex items-center justify-center text-gray-600 hover:bg-gray-100 active:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                    <input id="quantity" type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full h-12 text-center text-lg font-semibold text-gray-900 focus:outline-none" readonly>
                    <button type="button" onclick="increaseQuantity()" class="w-12 h-12 flex items-center justify-center text-gray-600 hover:bg-gray-100 active:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-4 sm:pt-6">
                <a href="{{route('cart.index')}}" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-4 px-6 rounded-2xl transition-all shadow-lg hover:shadow-purple-500/30 active:scale-95 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Add to Cart
                </a>
                <a href="#" class="flex-1 bg-gray-900 hover:bg-black text-center text-white font-semibold py-4 px-6 rounded-2xl transition-all shadow-lg hover:shadow-gray-500/30 active:scale-95">
                    Buy Now
                </a>
            </div>

        </div>
    </div>

    <div class="mt-12 lg:mt-16 border-t border-gray-200 pt-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-900">Product Description</h2>
        <div class="prose prose-lg text-gray-700 max-w-none leading-relaxed">
            {!! nl2br(e($product->description)) !!}
        </div>
    </div>
</div>

<script>
    const maxStock = @json($product->stock ?? 0);
    const quantityInput = document.getElementById('quantity');

    function updateButtonState() {
        const currentVal = parseInt(quantityInput.value);
        // Optional: Disable buttons if out of stock logic needed here
    }

    function increaseQuantity() {
        if (parseInt(quantityInput.value) < maxStock) {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
    }

    function decreaseQuantity() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }

    // Optional: Add thumbnail click logic if not using inline onclick
    document.querySelectorAll('.flex-shrink-0 img').forEach(thumb => {
        thumb.addEventListener('click', function() {
            document.querySelector('.main-image').src = this.src;
        });
    });
</script>

<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .scrollbar-hide {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>

@endsection