@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden md:flex">
        <div class="md:w-1/2">
            <img src="{{ $product->image }}" class="w-full h-full object-cover">
        </div>
        <div class="p-8 md:w-1/2">
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
            <p class="text-primary-600 text-2xl font-bold mt-2">Rs. {{ number_format($product->price, 2) }}</p>
            <p class="text-gray-600 mt-4">{{ $product->description }}</p>
            <p class="mt-2">Stock: <span class="font-semibold">{{ $product->stock }}</span></p>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6">
                @csrf
                <button class="bg-primary-600 text-white px-6 py-3 rounded-lg w-full hover:bg-primary-700">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection