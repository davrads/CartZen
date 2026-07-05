@extends('layouts.app')

@section('title', 'CartZen | Online Shopping Nepal')

@section('content')

{{-- ===== ANIMATED FULL-SCREEN BACKGROUND ===== --}}
<div class="fixed inset-0 -z-10 overflow-hidden">
    {{-- Color shifting gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-blue-500 to-pink-500 animate-gradient-shift"></div>

    {{-- Floating product silhouettes --}}
    <div class="absolute inset-0 opacity-10">
        <img src="https://loremflickr.com/80/80/headphones?random=1" class="floating-item w-16 h-16 absolute top-20 left-[10%]" alt="">
        <img src="https://loremflickr.com/80/80/shoe?random=2" class="floating-item w-20 h-20 absolute top-40 right-[15%]" alt="">
        <img src="https://loremflickr.com/80/80/watch?random=3" class="floating-item w-14 h-14 absolute bottom-32 left-[20%]" alt="">
        <img src="https://loremflickr.com/80/80/laptop?random=4" class="floating-item w-24 h-24 absolute top-1/3 right-[25%]" alt="">
        <img src="https://loremflickr.com/80/80/bag?random=5" class="floating-item w-16 h-16 absolute bottom-20 right-[10%]" alt="">
        <img src="https://loremflickr.com/80/80/shirt?random=6" class="floating-item w-18 h-18 absolute top-2/3 left-[30%]" alt="">
    </div>
</div>

<style>
    :root {
        --primary: #7c3aed;
        --primary-dark: #6d28d9;
        --accent: #f59e0b;
    }

    /* Background gradient animation */
    @keyframes gradient-shift {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .animate-gradient-shift {
        background-size: 200% 200%;
        animation: gradient-shift 8s ease infinite;
    }

    /* Floating items animation */
    @keyframes float {
        0%   { transform: translateY(0px) rotate(0deg); }
        50%  { transform: translateY(-15px) rotate(5deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }
    .floating-item {
        animation: float 6s ease-in-out infinite;
        filter: brightness(0) invert(1); /* makes them white silhouettes */
        opacity: 0.6;
    }
    .floating-item:nth-child(odd)  { animation-duration: 7s; }
    .floating-item:nth-child(even) { animation-duration: 5s; }

    .section-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02), 0 4px 12px rgba(0,0,0,0.03);
        transition: box-shadow 0.2s;
    }
    .section-card:hover {
        box-shadow: 0 2px 6px rgba(0,0,0,0.04), 0 10px 24px rgba(0,0,0,0.06);
    }

    .product-card {
        transition: all 0.25s ease;
        animation: fadeInUp 0.5s ease both;
    }
    .product-card:hover {
        transform: translateY(-6px);
        border-color: var(--primary);
        box-shadow: 0 14px 28px -12px rgba(124,58,237,0.2), 0 4px 12px -4px rgba(0,0,0,0.08);
    }
    .product-card:hover .product-image {
        transform: scale(1.07);
    }

    .flash-badge {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        animation: pulse 2s infinite;
    }

    .timer-box {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1.1rem;
        min-width: 50px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(124,58,237,0.25);
        border: 1px solid rgba(255,255,255,0.15);
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #fff !important;
        background: rgba(0,0,0,0.4) !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        backdrop-filter: blur(6px);
        transition: all 0.2s;
    }
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: rgba(0,0,0,0.6) !important;
        transform: scale(1.05);
    }
    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 18px !important;
        font-weight: bold;
    }
    .swiper-pagination-bullet-active {
        background-color: var(--primary) !important;
    }

    .section-heading {
        font-weight: 800;
        position: relative;
        padding-left: 1.25rem;
        color: #1f2937;
    }
    .section-heading::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 70%;
        background: var(--primary);
        border-radius: 4px;
    }

    .category-icon {
        background: linear-gradient(135deg, #faf5ff, #ede9fe);
    }
    .store-icon {
        background: linear-gradient(135deg, #ede9fe, #ddd6fe);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

{{-- Hero Banner --}}
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10">
    <div class="swiper mySwiper rounded-3xl overflow-hidden border-2 border-gray-100 shadow-lg h-[250px] sm:h-[350px] md:h-[420px]">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://img.lazcdn.com/us/domino/3606f8a8-9bed-4e80-9684-7963747c3b03_NP-1976-688.jpg_2200x2200q80.jpg_.avif" alt="Banner 1" class="w-full h-full object-cover">
            </div>
            <div class="swiper-slide">
                <img src="https://img.lazcdn.com/us/domino/a5d2ae98-753f-423a-a364-5979b673bbd1_NP-1976-688.jpg_2200x2200q80.jpg_.avif" alt="Banner 2" class="w-full h-full object-cover">
            </div>
            <div class="swiper-slide">
                <img src="https://img.lazcdn.com/us/domino/a19dfce6-fbbc-4244-9d2b-34324dbd17c0_NP-1976-688.jpg_2200x2200q80.jpg_.avif" alt="Banner 3" class="w-full h-full object-cover">
            </div>
        </div>
        <div class="swiper-button-next hidden sm:flex"></div>
        <div class="swiper-button-prev hidden sm:flex"></div>
        <div class="swiper-pagination !bottom-3"></div>
    </div>
</div>

{{-- ===== FLASH SALE ===== --}}
<section class="max-w-7xl mx-auto px-4 pb-8 min-h-[30px]">
    <div class="section-card p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-5 mb-8">
            <div class="flex items-center gap-4">
                <span class="text-4xl animate-bounce">⚡</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight">FLASH SALE</h2>
                @if(isset($flashSales) && $flashSales->count())
                <div class="flex items-center gap-2 ml-4"
                     x-data="flashCountdown('{{ $flashSales->min('ends_at')->toIso8601String() }}')">
                    <div class="timer-box" x-text="time.hours"></div>
                    <span class="text-2xl font-bold text-purple-600">:</span>
                    <div class="timer-box" x-text="time.minutes"></div>
                    <span class="text-2xl font-bold text-purple-600">:</span>
                    <div class="timer-box" x-text="time.seconds"></div>
                </div>
                @endif
            </div>
            <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition shadow-md font-semibold text-sm">
                Shop More <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
            @if(isset($flashSales) && $flashSales->count())
                @foreach($flashSales as $flash)
                    @php
                        $product = $flash->product;
                        $originalPrice = $product->price;
                        $discountPercent = $originalPrice > 0 ? round((($originalPrice - $flash->flash_price) / $originalPrice) * 100) : 0;
                        $imgUrl = $product->image ? Storage::url($product->image) : 'https://loremflickr.com/200/200/'.urlencode($product->name).'?random='.$product->id;
                    @endphp
                    <div class="product-card bg-white rounded-2xl p-4 text-center border border-gray-100" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <div class="relative overflow-hidden rounded-xl bg-gray-50 mb-3">
                            <img src="{{ $imgUrl }}"
                                 class="product-image w-full h-36 sm:h-44 object-cover transition-transform duration-300 mx-auto"
                                 alt="{{ $product->name }}"
                                 onerror="this.onerror=null; this.src='https://placehold.co/200x200/7c3aed/white?text={{ urlencode($product->name) }}';">
                            <div class="absolute top-3 left-3 flash-badge text-white text-[10px] sm:text-xs px-2.5 py-1 rounded-full font-bold shadow">
                                {{ $discountPercent }}% OFF
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-800 text-xs sm:text-sm mt-2 line-clamp-2 h-10">{{ $product->name }}</h3>
                        <div class="text-purple-600 font-bold text-lg mt-2">रु {{ number_format($flash->flash_price) }}</div>
                        <div class="text-gray-400 text-[11px] sm:text-xs line-through">रु {{ number_format($originalPrice) }}</div>
                    </div>
                @endforeach
            @else
                @php
                $dummyFlash = [
                    ['name' => 'Wireless Earbuds', 'price' => 1299, 'old' => 3999, 'disc' => '67%'],
                    ['name' => 'Men\'s Running Shoes', 'price' => 2499, 'old' => 5990, 'disc' => '58%'],
                    ['name' => 'Smart Watch Ultra', 'price' => 4999, 'old' => 12999, 'disc' => '62%'],
                    ['name' => 'Cotton T-Shirt', 'price' => 599, 'old' => 1499, 'disc' => '60%'],
                    ['name' => 'Power Bank 20000mAh', 'price' => 1799, 'old' => 3499, 'disc' => '49%'],
                    ['name' => 'Backpack 40L', 'price' => 1599, 'old' => 3200, 'disc' => '50%'],
                ];
                @endphp
                @foreach($dummyFlash as $i => $item)
                <div class="product-card bg-white rounded-2xl p-4 text-center border border-gray-100" style="animation-delay: {{ $i * 0.1 }}s">
                    <div class="relative overflow-hidden rounded-xl bg-gray-50 mb-3">
                        <img src="https://loremflickr.com/200/200/{{ urlencode($item['name']) }}?random={{ $i }}"
                             class="product-image w-full h-36 sm:h-44 object-cover transition-transform duration-300 mx-auto"
                             alt="{{ $item['name'] }}"
                             onerror="this.onerror=null; this.src='https://placehold.co/200x200/7c3aed/white?text={{ urlencode($item['name']) }}';">
                        <div class="absolute top-3 left-3 flash-badge text-white text-[10px] sm:text-xs px-2.5 py-1 rounded-full font-bold shadow">
                            {{ $item['disc'] }} OFF
                        </div>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-xs sm:text-sm mt-2 line-clamp-2 h-10">{{ $item['name'] }}</h3>
                    <div class="text-purple-600 font-bold text-lg mt-2">रु {{ number_format($item['price']) }}</div>
                    <div class="text-gray-400 text-[11px] sm:text-xs line-through">रु {{ number_format($item['old']) }}</div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ===== FEATURED PRODUCTS ===== --}}
<section class="max-w-7xl mx-auto px-4 pb-8 min-h-[30px]">
    <div class="mb-8">
        <h2 class="section-heading text-2xl md:text-3xl">Featured Products</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @if(isset($featuredProducts) && $featuredProducts->count())
            @foreach($featuredProducts as $product)
                <div class="product-card bg-white rounded-2xl border border-gray-100 overflow-hidden" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        @else
            @php
            $dummyFeatured = [
                ['name' => 'Nepali Dhaka Topi', 'price' => 850, 'old' => 1200],
                ['name' => 'Organic Green Tea', 'price' => 450, 'old' => 750],
                ['name' => 'Smart LED TV 32"', 'price' => 22999, 'old' => 29999],
                ['name' => 'Laptop Cooling Pad', 'price' => 1299, 'old' => 1999],
            ];
            @endphp
            @foreach($dummyFeatured as $i => $item)
            <div class="product-card bg-white rounded-2xl border border-gray-100 overflow-hidden" style="animation-delay: {{ $i * 0.1 }}s">
                <div class="relative overflow-hidden bg-gray-50">
                    <img src="https://loremflickr.com/400/300/{{ urlencode($item['name']) }}?random={{ $i }}"
                         class="w-full h-48 object-cover" alt="{{ $item['name'] }}"
                         onerror="this.onerror=null; this.src='https://placehold.co/400x300/7c3aed/white?text={{ urlencode($item['name']) }}';">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Best Seller</p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-lg font-bold text-purple-600">रु {{ number_format($item['price']) }}</span>
                        <span class="text-xs text-gray-400 line-through">रु {{ number_format($item['old']) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>

{{-- ===== SHOP BY CATEGORY ===== --}}
<section class="max-w-7xl mx-auto px-4 pb-8 min-h-[30px]">
    <div class="section-card p-6 md:p-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-5 mb-8">
            <h2 class="section-heading text-2xl md:text-3xl">Shop by Category</h2>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition shadow-md font-semibold text-sm">
                <span>All Categories</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4 md:gap-5">
            @if(isset($categories) && $categories->count())
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="product-card bg-white rounded-2xl p-4 text-center border border-gray-100 flex flex-col items-center justify-center h-36 sm:h-40" style="animation-delay: {{ $loop->index * 0.05 }}s">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full category-icon flex items-center justify-center mb-3 overflow-hidden">
                            <img src="{{ $category->image ? asset('storage/'.$category->image) : 'https://loremflickr.com/80/80/'.urlencode($category->name).'?random='.$category->id }}"
                                 alt="{{ $category->name }}" class="w-full h-full object-cover rounded-full"
                                 onerror="this.onerror=null; this.src='https://placehold.co/80x80/7c3aed/white?text={{ urlencode($category->name) }}';">
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-gray-700">{{ $category->name }}</span>
                    </a>
                @endforeach
            @else
                @php
                $dummyCategories = [
                    'Electronics', 'Fashion', 'Home & Living', 'Sports',
                    'Books', 'Toys', 'Beauty', 'Groceries'
                ];
                @endphp
                @foreach($dummyCategories as $i => $cat)
                <a href="#" class="product-card bg-white rounded-2xl p-4 text-center border border-gray-100 flex flex-col items-center justify-center h-36 sm:h-40" style="animation-delay: {{ $i * 0.05 }}s">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full category-icon flex items-center justify-center mb-3 overflow-hidden">
                        <img src="https://loremflickr.com/80/80/{{ urlencode($cat) }}?random={{ $i+50 }}"
                             alt="{{ $cat }}" class="w-full h-full object-cover rounded-full"
                             onerror="this.onerror=null; this.src='https://placehold.co/80x80/7c3aed/white?text={{ urlencode($cat) }}';">
                    </div>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">{{ $cat }}</span>
                </a>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ===== TOP STORES ===== --}}
<section class="max-w-7xl mx-auto px-4 pb-8 min-h-[30px]">
    <div class="section-card p-6 md:p-8 bg-purple-50/30 border-purple-100">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800">Top Stores on CartZen</h2>
            <p class="text-gray-500 mt-2">Handpicked verified sellers for you</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5 md:gap-6">
            @if(isset($topStores) && $topStores->count())
                @foreach($topStores as $store)
                    <div class="product-card bg-white rounded-2xl p-5 text-center border border-gray-100" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <div class="w-20 h-20 mx-auto rounded-full store-icon flex items-center justify-center text-2xl mb-4 overflow-hidden shadow-sm">
                            @if($store->shop_logo)
                                <img src="{{ Storage::url($store->shop_logo) }}" alt="{{ $store->shop_name }}" class="w-full h-full object-cover rounded-full"
                                     onerror="this.onerror=null; this.innerHTML='<i class=\'fas fa-store text-purple-600\'></i>';">
                            @else
                                <img src="https://loremflickr.com/80/80/store?random={{ $store->id }}" alt="{{ $store->shop_name }}" class="w-full h-full object-cover rounded-full"
                                     onerror="this.onerror=null; this.innerHTML='<i class=\'fas fa-store text-purple-600\'></i>';">
                            @endif
                        </div>
                        <h4 class="font-bold text-gray-800 text-base mb-1">{{ $store->shop_name }}</h4>
                        <p class="text-xs text-gray-400 mb-4 flex items-center justify-center gap-1">
                            <i class="fas fa-check-circle text-green-500"></i> Verified Seller
                        </p>
                        <a href="#" class="inline-block w-full py-2.5 text-sm font-semibold text-purple-700 bg-purple-50 rounded-xl hover:bg-purple-100 transition">
                            Visit Store
                        </a>
                    </div>
                @endforeach
            @else
                @php
                $dummyStores = [
                    'TechNepal', 'FashionHub', 'HomeEssentials', 'SportsWorld',
                    'BookNook', 'ToysGalore'
                ];
                @endphp
                @foreach($dummyStores as $i => $storeName)
                <div class="product-card bg-white rounded-2xl p-5 text-center border border-gray-100" style="animation-delay: {{ $i * 0.1 }}s">
                    <div class="w-20 h-20 mx-auto rounded-full store-icon flex items-center justify-center text-2xl mb-4 overflow-hidden shadow-sm">
                        <img src="https://loremflickr.com/80/80/store?random={{ $i+20 }}" alt="{{ $storeName }}" class="w-full h-full object-cover rounded-full"
                             onerror="this.onerror=null; this.innerHTML='<i class=\'fas fa-store text-purple-600\'></i>';">
                    </div>
                    <h4 class="font-bold text-gray-800 text-base mb-1">{{ $storeName }}</h4>
                    <p class="text-xs text-gray-400 mb-4 flex items-center justify-center gap-1">
                        <i class="fas fa-check-circle text-green-500"></i> Verified Seller
                    </p>
                    <a href="#" class="inline-block w-full py-2.5 text-sm font-semibold text-purple-700 bg-purple-50 rounded-xl hover:bg-purple-100 transition">
                        Visit Store
                    </a>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- Download App Banner --}}
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-3xl p-8 md:p-12 text-white shadow-xl border-2 border-purple-400/20 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="text-center md:text-left space-y-3">
            <h3 class="text-3xl md:text-4xl font-extrabold">Download CartZen App!</h3>
            <p class="text-purple-100 text-lg md:text-xl opacity-90">Get exclusive offers, faster checkout & easy returns</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto justify-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" class="h-11 md:h-12 w-auto cursor-pointer hover:opacity-90 transition transform hover:scale-105" alt="Google Play">
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" class="h-11 md:h-12 w-auto cursor-pointer hover:opacity-90 transition transform hover:scale-105" alt="App Store">
        </div>
    </div>
</div>

<div class="h-10"></div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: {
            320: { spaceBetween: 10, height: 250 },
            640: { spaceBetween: 20, height: 350 },
            768: { spaceBetween: 30, height: 420 },
        },
    });

    document.addEventListener('alpine:init', () => {
        Alpine.data('flashCountdown', (endDate) => ({
            end: new Date(endDate).getTime(),
            time: { hours: '00', minutes: '00', seconds: '00' },
            init() {
                this.updateTime();
                setInterval(() => this.updateTime(), 1000);
            },
            updateTime() {
                const now = Date.now();
                let diff = this.end - now;
                if (diff <= 0) {
                    this.time = { hours: '00', minutes: '00', seconds: '00' };
                    return;
                }
                this.time.hours = Math.floor(diff / (1000 * 60 * 60)).toString().padStart(2, '0');
                this.time.minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                this.time.seconds = Math.floor((diff % (1000 * 60)) / 1000).toString().padStart(2, '0');
            }
        }));
    });
</script>
@endpush