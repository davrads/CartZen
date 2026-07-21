@props(['flashSale'])

@php
    $product = $flashSale->product;
    $startTime = \Carbon\Carbon::parse($flashSale->start_date);
    $endTime = \Carbon\Carbon::parse($flashSale->end_date);
    $now = now();
    
    // Calculate remaining time
    $diff = $endTime->diff($now);
    $hours = $diff->h + ($diff->days * 24);
    $minutes = $diff->i;
    $seconds = $diff->s;
    
    // Calculate discount percentage
    $discountPercent = 0;
    if ($product->price > 0) {
        $discountPercent = round((($product->price - $flashSale->flash_price) / $product->price) * 100);
    }
    
    // Check if sale is active
    $isActive = $now->between($startTime, $endTime) && $flashSale->is_active;

    // Safe product URL: only real Eloquent Product models can generate a route
    // (dummy/fallback data is a plain stdClass and would break route() calls)
    $productUrl = ($product instanceof \App\Models\Product)
        ? route('products.show', $product)
        : '#';
@endphp

@if($isActive)
<div class="flash-card group relative bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">
    
    {{-- Flash Sale Badge & Discount --}}
    <div class="absolute top-3 left-3 z-20 flex flex-col gap-2">
        <div class="bg-red-600 text-white text-xs font-bold px-2.5 py-1 rounded-md shadow-md animate-pulse">
            Flash Sale
        </div>
        @if($discountPercent > 0)
            <div class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                -{{ $discountPercent }}%
            </div>
        @endif
    </div>

    {{-- Countdown Timer Overlay (Shows on Hover) --}}
    <div class="absolute inset-0 bg-black/40 z-10 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
        <p class="text-white text-sm font-semibold mb-2 uppercase tracking-wider">Ends In</p>
        <div class="flex gap-2 text-center">
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 min-w-[40px]">
                <span class="block text-white font-bold text-lg">{{ str_pad($hours, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="text-[10px] text-gray-200">Hrs</span>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 min-w-[40px]">
                <span class="block text-white font-bold text-lg">{{ str_pad($minutes, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="text-[10px] text-gray-200">Min</span>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 min-w-[40px]">
                <span class="block text-white font-bold text-lg">{{ str_pad($seconds, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="text-[10px] text-gray-200">Sec</span>
            </div>
        </div>
        <a href="{{ $productUrl }}" class="mt-3 bg-white text-red-600 text-xs font-bold px-4 py-2 rounded-full hover:bg-red-50 transition-colors">
            View Deal
        </a>
    </div>

    <div class="flex flex-col h-full justify-between">
        <a href="{{ $productUrl }}" class="block flex flex-col">
            
            {{-- Image Container (Square Aspect Ratio) --}}
            <div class="relative w-full aspect-square overflow-hidden bg-gray-50">
                <img
                    src="{{ ($product->thumbnail ?? null) ? asset('storage/' . $product->thumbnail) : asset('images/no-image.png') }}"
                    alt="{{ $product->name ?? 'Product' }}"
                    class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
            </div>

            {{-- Content --}}
            <div class="p-4 pb-0 flex flex-col flex-grow">
                <h3 class="font-medium text-base text-gray-800 line-clamp-2 min-h-[2.8rem]">
                    {{ $product->name ?? 'Product' }}
                </h3>

                <div class="mt-3 flex items-baseline gap-2 flex-wrap">
                    {{-- Flash Price --}}
                    <span class="text-xl font-bold text-red-600">
                        Rs. {{ number_format($flashSale->flash_price, 2) }}
                    </span>
                    
                    {{-- Original Price (Strikethrough) --}}
                    <span class="text-sm text-gray-400 line-through">
                        Rs. {{ number_format($product->price, 2) }}
                    </span>
                </div>

                {{-- Stock Bar (Optional Visual) --}}
                @php $productStock = $product->stock ?? 0; @endphp
                @if($productStock > 0)
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-red-500 h-1.5 rounded-full" style="width: {{ min(100, ($productStock / 10) * 100) }}%"></div>
                    </div>
                    <p class="text-[10px] text-gray-500 mt-1 text-right">
                        {{ $productStock }} left
                    </p>
                @else
                    <p class="mt-2 text-xs text-red-500 font-semibold">Sold Out</p>
                @endif
            </div>
        </a>

        {{-- Add to Cart Form Section (थपिएको भाग) --}}
        <div class="p-4 pt-3 z-20 relative">
            @if(($product->stock ?? 1) > 0)
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <!-- Normal Product ID -->
                    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                    
                    <!-- Flash Sale ID (सधैं Flash price तान्नको लागि) -->
                    <input type="hidden" name="flash_sale_id" value="{{ $flashSale->id ?? '' }}">
                    <input type="hidden" name="quantity" value="1">

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2.5 px-4 rounded-xl shadow-md transition-colors duration-200 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"></path>
                        </svg>
                        Add To Cart
                    </button>
                </form>
            @else
                <button disabled class="w-full bg-gray-300 text-gray-500 text-xs font-bold py-2.5 px-4 rounded-xl cursor-not-allowed">
                    Out of Stock
                </button>
            @endif
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    // Simple live countdown update for all cards on the page
    document.addEventListener('DOMContentLoaded', function() {
        // This script would ideally be more robust in a real app (e.g., Alpine.js or React)
        // For now, the static calculation in Blade is sufficient for the initial load.
    });
</script>
@endpush