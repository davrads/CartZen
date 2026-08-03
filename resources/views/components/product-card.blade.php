@props(['product'])

@php
    // Safe product URL
    $productUrl = ($product instanceof \App\Models\Product)
        ? route('products.show', $product)
        : '#';

    // Calculate discount percentage if original price/discount exists
    $discountPercent = 0;
    if (isset($product->original_price) && $product->original_price > $product->price) {
        $discountPercent = round((($product->original_price - $product->price) / $product->original_price) * 100);
    }
@endphp

<div class="product-card group relative bg-white rounded-lg sm:rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">
    
    {{-- Discount Badge (If Available) --}}
    @if($discountPercent > 0)
        <div class="absolute top-1 left-1 sm:top-3 sm:left-3 z-20">
            <div class="bg-red-100 text-red-600 text-[7px] sm:text-xs font-bold px-1 py-0.2 rounded-full shadow-sm leading-none">
                -{{ $discountPercent }}%
            </div>
        </div>
    @endif

    <div class="flex flex-col h-full justify-between">
        <a href="{{ $productUrl }}" class="block flex flex-col">
            
            {{-- Image Container (Square Aspect Ratio) --}}
            <div class="relative w-full aspect-square overflow-hidden bg-gray-50">
                <img
                    src="{{ ($product->thumbnail ?? null) ? asset('storage/' . $product->thumbnail) : asset('images/no-image.png') }}"
                    alt="{{ $product->name ?? 'Product' }}"
                    class="w-full h-full object-contain p-1 sm:p-4 group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
            </div>

            {{-- Content Section (Flash Card जस्तै exact font sizes र leading) --}}
            <div class="p-1.5 sm:p-4 pb-0 flex flex-col flex-grow">
                {{-- Title --}}
                <h3 class="font-medium text-[10px] sm:text-base text-gray-800 line-clamp-2 leading-tight min-h-[1.75rem] sm:min-h-[2.8rem]">
                    {{ $product->name ?? 'Product Name' }}
                </h3>

                {{-- Price Section --}}
                <div class="mt-1 sm:mt-3 flex flex-col sm:flex-row sm:items-baseline sm:gap-2">
                    {{-- Main Price --}}
                    <span class="text-[11px] sm:text-xl font-bold text-gray-900 leading-none">
                        Rs. {{ number_format($product->price ?? 0, 2) }}
                    </span>
                    
                    {{-- Original/Cross Price (If Available) --}}
                    @if(isset($product->original_price) && $product->original_price > $product->price)
                        <span class="text-[8px] sm:text-sm text-gray-400 line-through leading-none mt-0.5 sm:mt-0">
                            Rs. {{ number_format($product->original_price, 2) }}
                        </span>
                    @endif
                </div>

                {{-- Rating or Stock Info (Optional) --}}
                <div class="mt-1 flex items-center gap-0.5">
                    <i class="fas fa-star text-amber-400 text-[7px] sm:text-xs"></i>
                    <span class="text-[7px] sm:text-xs font-semibold text-gray-600 leading-none">
                        {{ number_format($product->rating ?? 4.5, 1) }}
                    </span>
                </div>
            </div>
        </a>

        {{-- Add to Cart Form Section --}}
        <div class="p-1.5 sm:p-4 pt-1 z-20 relative">
            @if(($product->stock ?? 1) > 0)
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                    <input type="hidden" name="quantity" value="1">

                    <button type="submit" class="w-full bg-violet-600 hover:bg-violet-700 text-white text-[8px] sm:text-xs font-bold py-1 sm:py-2.5 px-1 sm:px-4 rounded sm:rounded-xl shadow-xs sm:shadow-md transition-colors duration-200 flex items-center justify-center gap-0.5 sm:gap-2 leading-none">
                        <svg class="w-2.5 h-2.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"></path>
                        </svg>
                        <span class="truncate">Add To Cart</span>
                    </button>
                </form>
            @else
                <button disabled class="w-full bg-gray-300 text-gray-500 text-[8px] sm:text-xs font-bold py-1 sm:py-2.5 px-1 sm:px-4 rounded sm:rounded-xl cursor-not-allowed leading-none">
                    Out of Stock
                </button>
            @endif
        </div>
    </div>
</div>