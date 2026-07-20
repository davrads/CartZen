@props(['product'])

<div class="product-card bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
    <a href="{{ route('products.show', $product) }}" class="block flex flex-col h-full">

        <div class="relative">
            
            @php
                // Check for Active Flash Sale
                $hasActiveFlash = false;
                $flashPrice = 0;
                
                if ($product->relationLoaded('flashSale') && $product->flashSale) {
                    $now = now();
                    if ($now->between($product->flashSale->start_date, $product->flashSale->end_date)) {
                        $hasActiveFlash = true;
                        $flashPrice = $product->flashSale->flash_price;
                    }
                }
            @endphp

            {{-- Badges: Flash Sale takes priority over Featured --}}
            @if($hasActiveFlash)
                <div class="absolute top-3 right-3 bg-red-600 text-white text-xs font-bold px-2.5 py-1 rounded-md z-20 shadow-sm animate-pulse">
                    Flash Sale
                </div>
            @elseif($product->featured)
                <div class="absolute top-3 right-3 bg-violet-600 text-white text-xs font-bold px-2.5 py-1 rounded-md z-20 shadow-sm">
                    Featured
                </div>
            @endif

            <div class="bg-gray-50 p-4 md:p-6 flex items-center justify-center h-64 md:h-72">
                <img
                    src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('images/no-image.png') }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-contain max-h-full"
                    loading="lazy"
                    onerror="this.src='{{ asset('images/no-image.png') }}';"
                >
            </div>
        </div>

        <div class="p-4 md:p-5 flex flex-col flex-grow">
            <h3 class="font-medium text-base md:text-lg text-gray-800 line-clamp-2 min-h-[2.5rem] mb-2">
                {{ $product->name ?? 'Unnamed Product' }}
            </h3>

            <div class="mt-auto flex items-center gap-2 flex-wrap">
                @php
                    $displayPrice = $product->price ?? 0;
                    $originalPrice = $product->price ?? 0;
                    $hasDiscount = false;

                    // Priority 1: Active Flash Sale
                    if ($hasActiveFlash) {
                        $displayPrice = $flashPrice;
                        $hasDiscount = true;
                    }
                    // Priority 2: sale_price attribute
                    elseif (isset($product->sale_price) && $product->sale_price > 0 && $product->sale_price < $originalPrice) {
                        $displayPrice = $product->sale_price;
                        $hasDiscount = true;
                    }
                    // Priority 3: discounted_price attribute (legacy)
                    elseif (isset($product->discounted_price) && $product->discounted_price > 0 && $product->discounted_price < $originalPrice) {
                        $displayPrice = $product->discounted_price;
                        $hasDiscount = true;
                    }
                @endphp

                @if($hasDiscount)
                    <span class="text-xl md:text-2xl font-bold text-gray-900">
                        Rs. {{ number_format($displayPrice, 2) }}
                    </span>
                    <span class="text-sm md:text-base text-gray-400 line-through">
                        Rs. {{ number_format($originalPrice, 2) }}
                    </span>
                @else
                    <span class="text-xl md:text-2xl font-bold text-gray-900">
                        Rs. {{ number_format($displayPrice, 2) }}
                    </span>
                @endif
            </div>

            @if(isset($product->brand) && $product->brand)
                <p class="text-xs md:text-sm text-gray-500 mt-2">
                    {{ $product->brand }}
                </p>
            @endif
        </div>
    </a>
</div>