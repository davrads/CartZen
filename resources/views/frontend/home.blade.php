@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-primary-800 to-primary-600 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-extrabold mb-4">Welcome to Cartzen</h1>
        <p class="text-xl mb-8">Best multi-vendor marketplace – shop from thousands of trusted vendors</p>
        <a href="{{ route('shop') }}" class="bg-white text-primary-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100">Shop Now</a>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Featured Categories</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <div class="bg-white p-4 rounded-xl shadow text-center">
                <div class="text-primary-600 text-4xl mb-2">🛍️</div>
                <h3 class="font-semibold">{{ $category->name }}</h3>
            </div>
        @endforeach
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Featured Products</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($featuredProducts as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>
</div>

<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Top Vendors</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($vendors as $vendor)
                <div class="bg-white p-6 rounded-xl shadow text-center">
                    <h3 class="text-xl font-bold">{{ $vendor->shop_name }}</h3>
                    <a href="{{ route('vendor.store', $vendor->id) }}" class="text-primary-600 mt-2 inline-block">Visit Store →</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection