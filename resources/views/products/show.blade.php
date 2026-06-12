@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-1/2">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg">
        </div>
        <div class="md:w-1/2">
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
            <div class="flex items-center space-x-3 mt-2">
                <span class="text-orange-600 text-2xl font-bold">Rs. {{ number_format($product->price) }}</span>
                @if($product->compare_price)
                    <span class="text-gray-400 line-through">Rs. {{ number_format($product->compare_price) }}</span>
                    <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">{{ $product->discount }}% off</span>
                @endif
            </div>
            <p class="mt-4 text-gray-600">{{ $product->description }}</p>
            <p class="mt-2"><strong>Stock:</strong> {{ $product->stock > 0 ? $product->stock : 'Out of stock' }}</p>

            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6 flex items-center space-x-4">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 border rounded px-3 py-2">
                    <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700">Add to Cart</button>
                </form>
            @else
                <p class="mt-6 text-red-600">Out of stock</p>
            @endif
        </div>
    </div>

    @if($related->count())
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($related as $rel)
                    <div class="border rounded p-4">
                        <img src="{{ asset('storage/'.$rel->image) }}" class="w-full h-32 object-cover rounded">
                        <h3 class="font-semibold mt-2">{{ $rel->name }}</h3>
                        <p class="text-orange-600">Rs. {{ number_format($rel->price) }}</p>
                        <a href="{{ route('product.show', $rel->slug) }}" class="text-sm text-orange-600">View →</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection