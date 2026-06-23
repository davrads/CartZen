@props(['product'])

<div class="product-card bg-white rounded-2xl overflow-hidden border hover:shadow-lg transition-shadow">
    <a href="{{ route('products.show', $product) }}">

        <div class="relative">

            @if($product->featured)
                <div class="absolute top-4 right-4 bg-violet-600 text-white text-xs font-bold px-2 py-1 rounded z-10">
                    Featured
                </div>
            @endif

            <img
                src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('images/no-image.png') }}"
                alt="{{ $product->name }}"
                class="w-full h-80 object-contain bg-gray-50 p-8"
            >
        </div>

        <div class="p-5">

            <h3 class="font-medium text-lg text-gray-800">
                {{ $product->name }}
            </h3>

            <div class="mt-3 flex items-center gap-2 flex-wrap">

                @if($product->discounted_price)

                    <span class="text-2xl font-bold text-gray-900">
                        Rs. {{ number_format($product->discounted_price, 2) }}
                    </span>

                    <span class="text-gray-400 line-through text-lg">
                        Rs. {{ number_format($product->price, 2) }}
                    </span>

                @else

                    <span class="text-2xl font-bold text-gray-900">
                        Rs. {{ number_format($product->price, 2) }}
                    </span>

                @endif

            </div>

            @if($product->brand)
                <p class="text-sm text-gray-500 mt-2">
                    {{ $product->brand }}
                </p>
            @endif

        </div>

    </a>
</div>