<div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition group">
    <img src="{{ $product->image ?? 'https://placehold.co/600x400' }}" alt="{{ $product->name }}" class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
    <div class="p-4">
        <h2 class="text-xl font-semibold truncate">{{ $product->name }}</h2>
        <p class="text-primary-600 font-bold text-lg mt-1">Rs. {{ number_format($product->price, 2) }}</p>
        <a href="{{ route('product.show', $product->slug) }}" class="inline-block mt-3 bg-primary-600 text-white px-4 py-2 rounded-lg w-full text-center hover:bg-primary-700">View Product</a>
    </div>
</div>