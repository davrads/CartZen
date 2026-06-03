@extends('layouts.app')

@section('title', 'Cartzen - Online Shopping Nepal')

@section('content')
    <!-- Hero Banner -->
    <section class="hero-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight">Big Deals, Better Life</h1>
                <p class="text-3xl mt-4">Up to 60% Off on Top Products</p>
                <a href="#" class="mt-8 inline-block bg-white text-purple-700 px-12 py-4 rounded-2xl font-bold text-xl hover:scale-105 transition">Shop Now</a>
            </div>
            <div class="flex justify-center">
                <img src="https://via.placeholder.com/620x420/ffffff/6B46C1?text=Premium+Products" class="rounded-3xl shadow-2xl" alt="Hero">
            </div>
        </div>
    </section>

    <!-- Flash Deals -->
    <section class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold flex items-center gap-3">
            <span class="text-red-500">⚡</span> Flash Deals
        </h2>
        <span class="bg-red-100 text-red-600 px-6 py-2 rounded-xl font-semibold" id="timer">02:45:18</span>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <x-product-card :discount="true" />
        <x-product-card :discount="true" 
                        name="boAt Rockers 450 Headphones"
                        price="2,399"
                        original_price="3,499" />
        <x-product-card name="Xiaomi Redmi Note 13" 
                        price="23,999" />
        <x-product-card :discount="true" 
                        name="Realme C67 5G"
                        price="17,999"
                        original_price="21,999" />
    </div>
    </section>

    <!-- Top Categories -->
    <section class="max-w-7xl mx-auto px-6 py-12 bg-white">
        <h2 class="text-2xl font-bold mb-8">Top Categories</h2>
        <div class="grid grid-cols-4 md:grid-cols-8 gap-6">
            <!-- Add more category cards as needed -->
        </div>
    </section>
@endsection

@push('scripts')
<script>
    let time = 45*60 + 18;
    setInterval(() => {
        time--;
        const m = Math.floor(time / 60).toString().padStart(2, '0');
        const s = (time % 60).toString().padStart(2, '0');
        document.getElementById('timer').textContent = `${m}:${s}`;
    }, 1000);
</script>
@endpush



{{-- @extends('layouts.app')

@section('content')

<!-- Hero Banner -->
    <section class="hero-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight">Big Deals, Better Life</h1>
                <p class="text-3xl mt-4">Up to 60% Off on Top Products</p>
                <a href="#" class="mt-8 inline-block bg-white text-purple-700 px-12 py-4 rounded-2xl font-bold text-xl hover:scale-105 transition">Shop Now</a>
            </div>
            <div class="flex justify-center">
                <img src="https://via.placeholder.com/620x420/ffffff/6B46C1?text=Premium+Products" class="rounded-3xl shadow-2xl" alt="Hero">
            </div>
        </div>
    </section>

    <!-- Flash Deals -->
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold flex items-center gap-3">
                <span class="text-red-500">⚡</span> Flash Deals
            </h2>
            <span class="bg-red-100 text-red-600 px-6 py-2 rounded-xl font-semibold" id="timer">02:45:18</span>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach(range(1,5) as $i)
                <x-product-card :discount="true" />
            @endforeach
        </div>
    </section>

    <!-- Top Categories -->
    <section class="max-w-7xl mx-auto px-6 py-12 bg-white">
        <h2 class="text-2xl font-bold mb-8">Top Categories</h2>
        <div class="grid grid-cols-4 md:grid-cols-8 gap-6">
            <!-- Add more category cards as needed -->
        </div>
    </section>
@endsection

@push('scripts')
<script>
    let time = 45*60 + 18;
    setInterval(() => {
        time--;
        const m = Math.floor(time / 60).toString().padStart(2, '0');
        const s = (time % 60).toString().padStart(2, '0');
        document.getElementById('timer').textContent = `${m}:${s}`;
    }, 1000);
</script>
@endpush

{{-- <div class="bg-gradient-to-r from-primary-800 to-primary-600 text-white py-20">
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
</div> --}} 