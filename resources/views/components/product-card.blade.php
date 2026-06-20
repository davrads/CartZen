@props(['product'])
<div class="product-card bg-white rounded-2xl overflow-hidden border">
    <a href="{{ route('products.show', $product) }}">
                        <div class="relative">
                            @if ($product->discounted_price)
                            <div class="discount-badge absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">{{ $product->discount }}% OFF</div>
                            @endif
                            <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}"
                                class="w-full h-80 object-contain bg-gray-50 p-8">
                        </div>
                        <div class="p-5">
                            <h3 class="font-medium text-lg text-gray-800">{{ $product->name }}</h3>
                            <div class="mt-3 flex items-center gap-2">
                                <span class="text-2xl font-bold text-gray-900">Rs.{{number_format($product->discounted_price,2) }}</span>
                                <span class="text-gray-400 line-through text-lg">Rs.{{number_format($product->price,2) }}</span>
                            </div>
                            <div class="flex items-center gap-1 mt-3">
                                <span class="text-yellow-400 text-xl">★★★★☆</span>
                                <span class="text-gray-500 text-sm">(138)</span>
                            </div>
                        </div>
                    </div>