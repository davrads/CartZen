@extends('layouts.app')

@section('title', $product->name . ' - CartZen')

@section('content')

{{-- Success Alert --}}
@if(session('success'))
<div id="success-alert" class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-100 shadow-xl transition-all duration-500 max-w-sm sm:max-w-md animate-fade-in">
    <svg class="flex-shrink-0 w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
    <div class="ml-3 text-sm font-semibold tracking-wide pr-4">
        {{ session('success') }}
    </div>
    <button type="button" onclick="document.getElementById('success-alert').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex h-8 w-8 transition-colors">
        <span class="sr-only">Close</span>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
@endif

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 flex items-center gap-2 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-violet-600 transition-colors">Home</a>
        <span class="text-gray-400">/</span>
        @if($product->category)
        <a href="{{ route('categories.show', $product->category) }}" class="hover:text-violet-600 transition-colors">
            {{ $product->category->name }}
        </a>
        <span class="text-gray-400">/</span>
        @endif
        <span class="font-medium text-gray-900 truncate">{{ $product->name }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

        {{-- Left: Image Gallery --}}
        <div class="w-full lg:w-1/2 flex-shrink-0">
            <div class="flex flex-col-reverse lg:flex-row gap-4">

                {{-- Thumbnails --}}
                <div class="flex lg:flex-col gap-3 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 scrollbar-hide w-auto lg:w-24 flex-shrink-0">
                    @php
                    $images = $product->images ?? collect();
                    // Add thumbnail if no images exist or prepend it
                    if($product->thumbnail && $images->count() > 0) {
                    // Ensure thumbnail is the first item if not already
                    if($images->first()->product_image !== $product->thumbnail) {
                    $images = collect([$product->thumbnail])->merge($images);
                    }
                    } elseif ($product->thumbnail) {
                    $images = collect([$product->thumbnail]);
                    }
                    @endphp

                    @forelse($images as $index => $image)
                    @php
                    $imgSrc = is_string($image) ? asset('storage/' . $image) : asset('storage/' . $image->product_image);
                    @endphp
                    <div class="h-16 w-16 lg:h-20 lg:w-20 flex-shrink-0 rounded-xl overflow-hidden border-2 {{ $loop->first ? 'border-violet-600' : 'border-transparent' }} hover:border-violet-600 cursor-pointer transition-all bg-gray-50 shadow-sm">
                        <img class="h-full w-full object-cover"
                            src="{{ $imgSrc }}"
                            alt="View {{ $loop->index + 1 }}"
                            onclick="updateMainImage(this, {{ $loop->index }})">
                    </div>
                    @empty
                    <div class="h-16 w-16 lg:h-20 lg:w-20 flex-shrink-0 rounded-xl overflow-hidden border-2 border-violet-600 bg-gray-50 flex items-center justify-center text-gray-400 text-xs text-center p-1">
                        No Images
                    </div>
                    @endforelse
                </div>

                {{-- Main Image --}}
                <div class="flex-1">
                    <div class="aspect-square w-full rounded-3xl overflow-hidden shadow-xl border border-gray-100 bg-white relative group">
                        {{-- Flash Sale Badge (if applicable) --}}
                        @if($product->is_flash_sale ?? $product->flashSale)
                        <div class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full z-10 shadow-md animate-pulse">
                            Flash Sale
                        </div>
                        @elseif($product->featured)
                        <div class="absolute top-4 left-4 bg-violet-600 text-white text-xs font-bold px-3 py-1.5 rounded-full z-10 shadow-md">
                            Featured
                        </div>
                        @endif

                        <img id="mainImage"
                            class="h-full w-full object-contain p-4 transition-transform duration-300 group-hover:scale-105"
                            src="{{ asset('storage/' . $product->thumbnail) }}"
                            alt="{{ $product->name }}">

                        {{-- Zoom Icon Overlay --}}
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <svg class="w-12 h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Product Details --}}
        <div class="w-full lg:w-1/2 flex flex-col gap-6">

            {{-- Header --}}
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight mb-2">
                    {{ $product->name }}
                </h1>

                <div class="flex flex-wrap items-center gap-4 text-sm">
                    <div class="flex items-center text-yellow-400">
                        <span>★★★★☆</span>
                        <span class="ml-2 text-gray-600 font-medium">4.5 (128 reviews)</span>
                    </div>
                    <span class="text-gray-300 hidden sm:inline">•</span>
                    <span class="text-gray-600">{{ $product->sold_count ?? 0 }}+ Sold</span>
                </div>
            </div>

            {{-- Price --}}
            <div class="flex items-end gap-3 sm:gap-4 flex-wrap bg-gray-50 p-4 rounded-2xl border border-gray-100">
                @if($product->discounted_price)
                <span class="text-3xl sm:text-4xl font-bold text-violet-600">
                    Rs. {{ number_format($product->discounted_price, 2) }}
                </span>
                <span class="text-lg sm:text-xl text-gray-400 line-through mb-1">
                    Rs. {{ number_format($product->price, 2) }}
                </span>
                <span class="bg-red-100 text-red-600 text-xs font-bold px-2.5 py-1 rounded-full mb-1">
                    SAVE {{ number_format((($product->price - $product->discounted_price) / $product->price) * 100, 0) }}%
                </span>
                @else
                <span class="text-3xl sm:text-4xl font-bold text-violet-600">
                    Rs. {{ number_format($product->price, 2) }}
                </span>
                @endif
            </div>

            {{-- Meta Info --}}
            <div class="text-sm text-gray-600 space-y-1">
                @if($product->brand)
                <p><span class="font-semibold text-gray-800">Brand:</span> {{ $product->brand }}</p>
                @endif
                <p><span class="font-semibold text-gray-800">SKU:</span> {{ $product->sku }}</p>
                @if($product->stock > 0)
                <p class="flex items-center gap-1.5 text-green-700 font-medium">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    In Stock ({{ $product->stock }} available)
                </p>
                @else
                <p class="flex items-center gap-1.5 text-red-700 font-medium">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Out of Stock
                </p>
                @endif
            </div>

            <hr class="border-gray-100">

            {{-- Form --}}
            @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="price" id="selectedPrice" value="{{ $product->price }}">

                {{-- Variants --}}
                @if($product->variants && $product->variants->count() > 0)
                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Select Variant</h3>
                    <div class="relative">
                        <select name="product_variant_id"
                            id="variantSelect"
                            class="w-full appearance-none border border-gray-300 rounded-xl p-4 pr-10 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition-shadow cursor-pointer text-base">
                            <option value="">-- Select Option --</option>
                            @foreach($product->variants as $variant)
                            <option value="{{ $variant->id }}"
                                data-price="{{ $variant->price }}"
                                data-stock="{{ $variant->stock ?? $product->stock }}">
                                {{ $variant->color ?? 'Default' }} - {{ $variant->size ?? 'One Size' }} - Rs. {{ number_format($variant->price, 2) }}
                            </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <p id="variantPrice" class="mt-2 text-sm font-semibold text-violet-600 hidden">Selected Price: Rs. 0.00</p>
                    @else
                    <input type="hidden" name="product_variant_id" value="">
                    @endif
                </div>

                {{-- Quantity --}}
                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Quantity</h3>
                    <div class="flex items-center w-full sm:w-48 border border-gray-300 rounded-2xl overflow-hidden bg-white">
                        <button type="button" onclick="decreaseQuantity()" class="w-12 h-12 flex items-center justify-center text-gray-600 hover:bg-gray-100 active:bg-gray-200 transition-colors text-xl font-bold">-</button>
                        <input id="quantity" type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full h-12 text-center text-lg font-semibold text-gray-900 focus:outline-none">
                        <button type="button" onclick="increaseQuantity()" class="w-12 h-12 flex items-center justify-center text-gray-600 hover:bg-gray-100 active:bg-gray-200 transition-colors text-xl font-bold">+</button>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <button type="submit" class="flex-1 bg-violet-600 hover:bg-violet-700 text-white font-semibold py-4 px-6 rounded-2xl transition-all shadow-lg hover:shadow-violet-500/30 active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Add to Cart
                    </button>
                    <button type="submit" name="buy_now" value="1" class="flex-1 bg-gray-900 hover:bg-black text-white font-semibold py-4 px-6 rounded-2xl transition-all shadow-lg hover:shadow-gray-500/30 active:scale-95">
                        Buy Now
                    </button>
                </div>
            </form>
            @else
            <div class="text-center py-8 bg-gray-50 rounded-2xl border border-gray-200">
                <p class="text-gray-600 font-medium">This product is currently out of stock.</p>
                <button class="mt-4 text-violet-600 font-semibold hover:underline">Notify Me When Available</button>
            </div>
            @endif

            {{-- Short Description --}}
            @if($product->description)
            <div class="mt-4 border-t border-gray-100 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
            @endif

            {{-- Features/Benefits (Optional if you have a features column) --}}
            @if($product->features)
            <div class="mt-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Key Features</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-gray-600">
                    @foreach(explode(',', $product->features) as $feature)
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        {{ trim($feature) }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
    </div>

    

</div>

{{-- Scripts --}}
<script>
    // --- Image Gallery Logic ---
    function updateMainImage(element, index) {
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.flex-shrink-0 img'); // Select all thumbnail images

        // Update main image source
        mainImage.src = element.src;

        // Update border styles for active state
        thumbnails.forEach((thumb, i) => {
            const parent = thumb.parentElement;
            if (i === index) {
                parent.classList.add('border-violet-600');
                parent.classList.remove('border-transparent');
            } else {
                parent.classList.remove('border-violet-600');
                parent.classList.add('border-transparent');
            }
        });
    }

    // --- Quantity Logic ---
    const quantityInput = document.getElementById('quantity');
    const maxStockInput = quantityInput ? parseInt(quantityInput.max) : 1;

    function increaseQuantity() {
        if (quantityInput && parseInt(quantityInput.value) < maxStockInput) {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
    }

    function decreaseQuantity() {
        if (quantityInput && parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }

    // --- Variant Price Logic ---
    const variantSelect = document.getElementById('variantSelect');
    const variantPriceDisplay = document.getElementById('variantPrice');
    const selectedPriceInput = document.getElementById('selectedPrice');

    if (variantSelect) {
        variantSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const stock = selectedOption.getAttribute('data-stock');

            if (price && price !== "null") {
                // Update display
                if (variantPriceDisplay) variantPriceDisplay.classList.remove('hidden');
                if (variantPriceDisplay) variantPriceDisplay.textContent = `Selected Price: Rs. ${parseFloat(price).toFixed(2)}`;

                // Update hidden input for form submission
                if (selectedPriceInput) selectedPriceInput.value = price;

                // Update max quantity based on variant stock if available
                if (stock && stock !== "null" && quantityInput) {
                    quantityInput.max = stock;
                    if (parseInt(quantityInput.value) > parseInt(stock)) {
                        quantityInput.value = 1;
                    }
                }
            } else {
                if (variantPriceDisplay) variantPriceDisplay.classList.add('hidden');
                if (selectedPriceInput) selectedPriceInput.value = @json($product -> price);
            }
        });
    }

    // --- Auto-hide Success Alert ---
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 500);
        }, 4000);
    }
</script>

<style>
    /* Custom Scrollbar Hide for Thumbnails */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Smooth Fade In Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }

    /* Image Transition */
    .main-image {
        transition: opacity 0.3s ease-in-out;
    }

    .main-image[src] {
        opacity: 1;
    }
</style>

@endsection