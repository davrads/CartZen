@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-6">
    {{-- Sidebar: Categories --}}
    <aside class="w-full md:w-64 bg-white rounded-lg shadow p-4">
        <h3 class="font-bold text-lg mb-3">All Categories</h3>
        <ul class="space-y-2">
            <li><a href="{{ route('products.index') }}" class="text-gray-700 hover:text-orange-600 {{ request()->routeIs('products.index') && !request()->category ? 'font-semibold text-orange-600' : '' }}">All Products</a></li>
            @foreach($categories as $cat)
                <li>
                    <a href="{{ route('products.index', $cat->slug) }}" 
                       class="text-gray-700 hover:text-orange-600 {{ request()->category == $cat->slug ? 'font-semibold text-orange-600' : '' }}">
                        {{ $cat->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>

    {{-- Product Grid --}}
    <div class="flex-1">
        <h1 class="text-2xl font-bold mb-6">
            {{ request()->category ? ucfirst(request()->category) : 'All Products' }}
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="font-semibold text-lg">{{ $product->name }}</h2>
                        <div class="flex items-center space-x-2 mt-2">
                            <span class="text-orange-600 font-bold text-xl">Rs. {{ number_format($product->price) }}</span>
                            @if($product->compare_price)
                                <span class="text-gray-400 line-through text-sm">Rs. {{ number_format($product->compare_price) }}</span>
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">{{ $product->discount }}% off</span>
                            @endif
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <a href="{{ route('product.show', $product->slug) }}" class="text-orange-600 hover:underline">View Details</a>
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-orange-600 text-white px-3 py-1 rounded text-sm hover:bg-orange-700">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">No products found.</p>
            @endforelse
        </div>
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection