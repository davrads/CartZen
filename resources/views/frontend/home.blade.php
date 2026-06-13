@extends('layouts.app')

@section('title', 'CartZen | Online Shopping Nepal')

@section('content')

<!-- Custom Styles for CartZen Look -->
<style>
    /* CartZen-inspired gradient and hover effects */
    .CartZen-gradient-bg {
        background: linear-gradient(135deg, #f85606 0%, #ff9c00 100%);
    }
    .flash-badge {
        background: linear-gradient(135deg, #ff6b00, #f85606);
    }
    .product-card:hover .product-image {
        transform: scale(1.08);
    }
    .category-card {
        transition: all 0.2s ease;
    }
    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .swiper-button-next, .swiper-button-prev {
        color: #fff !important;
        background: rgba(0,0,0,0.5);
        width: 40px !important;
        height: 40px !important;
        border-radius: 50%;
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 18px !important;
    }
    .timer-box {
        background: #2c2c2c;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: bold;
        min-width: 55px;
        text-align: center;
    }
</style>

<!-- Font Awesome & Swiper CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- ========== MAIN CAROUSEL (SWIPER) ========== -->
<div class="max-w-7xl mx-auto px-4 mt-5">
    <div class="swiper mySwiper rounded-xl overflow-hidden shadow-md">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://img.lazcdn.com/us/domino/3606f8a8-9bed-4e80-9684-7963747c3b03_NP-1976-688.jpg_2200x2200q80.jpg_.avif" alt="Banner 1" class="w-full h-48 md:h-72 object-cover">
            </div>
            <div class="swiper-slide">
                <img src="https://img.lazcdn.com/us/domino/a5d2ae98-753f-423a-a364-5979b673bbd1_NP-1976-688.jpg_2200x2200q80.jpg_.avif" alt="Banner 2" class="w-full h-48 md:h-72 object-cover">
            </div>
            <div class="swiper-slide">
                <img src="https://img.lazcdn.com/us/domino/a19dfce6-fbbc-4244-9d2b-34324dbd17c0_NP-1976-688.jpg_2200x2200q80.jpg_.avif" alt="Banner 3" class="w-full h-48 md:h-72 object-cover">
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- ========== FLASH SALE SECTION ========== -->
<section class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                <span class="text-3xl animate-pulse">⚡</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800">FLASH SALE</h2>
                <div class="flex gap-2 ml-4">
                    <div class="timer-box bg-red-600 text-white" id="flashHours">02</div>
                    <span class="text-2xl font-bold text-red-600">:</span>
                    <div class="timer-box bg-red-600 text-white" id="flashMinutes">45</div>
                    <span class="text-2xl font-bold text-red-600">:</span>
                    <div class="timer-box bg-red-600 text-white" id="flashSeconds">18</div>
                </div>
            </div>
            <a href="#" class="text-purple-500 font-semibold hover:underline">Shop More <i class="fas fa-angle-right"></i></a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @php
                $flashProducts = [
                    ['name' => 'Smart Watch', 'price' => 2499, 'old' => 5999, 'img' => 'https://via.placeholder.com/200x200?text=Watch', 'discount' => '58%'],
                    ['name' => 'Wireless Earbuds', 'price' => 1799, 'old' => 3999, 'img' => 'https://via.placeholder.com/200x200?text=Earbuds', 'discount' => '55%'],
                    ['name' => 'Men\'s Sneakers', 'price' => 2890, 'old' => 6990, 'img' => 'https://via.placeholder.com/200x200?text=Shoes', 'discount' => '58%'],
                    ['name' => 'Backpack', 'price' => 1550, 'old' => 3200, 'img' => 'https://via.placeholder.com/200x200?text=Bag', 'discount' => '51%'],
                    ['name' => 'T-Shirt', 'price' => 599, 'old' => 1499, 'img' => 'https://via.placeholder.com/200x200?text=Tshirt', 'discount' => '60%'],
                    ['name' => 'Power Bank', 'price' => 1299, 'old' => 2999, 'img' => 'https://via.placeholder.com/200x200?text=PowerBank', 'discount' => '56%'],
                ];
            @endphp
            @foreach($flashProducts as $item)
            <div class="product-card group bg-white rounded-lg p-3 text-center hover:shadow-lg transition duration-300 border border-gray-100">
                <div class="relative overflow-hidden rounded-md">
                    <img src="{{ $item['img'] }}" class="product-image w-full h-40 object-contain transition-transform duration-300 mx-auto" alt="{{ $item['name'] }}">
                    <div class="absolute top-2 left-2 flash-badge text-white text-xs px-2 py-1 rounded-full font-bold">{{ $item['discount'] }} OFF</div>
                </div>
                <h3 class="font-semibold text-gray-800 text-sm mt-2 line-clamp-1">{{ $item['name'] }}</h3>
                <div class="text-red-600 font-bold text-lg mt-1">रु {{ number_format($item['price']) }}</div>
                <div class="text-gray-400 text-xs line-through">रु {{ number_format($item['old']) }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========== CATEGORIES SECTION (CartZen STYLE) ========== -->
<section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-l-4 border-purple-500 pl-3">Shop by Category</h2>
    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-5">
        @php
            $cats = [
                ['name'=>'Electronics','icon'=>'fas fa-mobile-alt','color'=>'bg-blue-100'],
                ['name'=>'Fashion','icon'=>'fas fa-tshirt','color'=>'bg-pink-100'],
                ['name'=>'Home & Living','icon'=>'fas fa-couch','color'=>'bg-green-100'],
                ['name'=>'Baby & Toys','icon'=>'fas fa-baby-carriage','color'=>'bg-yellow-100'],
                ['name'=>'Sports','icon'=>'fas fa-futbol','color'=>'bg-indigo-100'],
                ['name'=>'Health','icon'=>'fas fa-heartbeat','color'=>'bg-red-100'],
                ['name'=>'Automotive','icon'=>'fas fa-car','color'=>'bg-gray-200'],
                ['name'=>'Books','icon'=>'fas fa-book','color'=>'bg-purple-100'],
            ];
        @endphp
        @foreach($cats as $cat)
        <a href="#" class="category-card bg-white rounded-2xl p-4 text-center shadow-sm hover:shadow-md transition-all border">
            <div class="w-14 h-14 mx-auto {{ $cat['color'] }} rounded-full flex items-center justify-center text-2xl mb-3">
                <i class="{{ $cat['icon'] }} text-gray-700"></i>
            </div>
            <span class="text-xs font-medium text-gray-700">{{ $cat['name'] }}</span>
        </a>
        @endforeach
    </div>
</section>

<!-- ========== JUST FOR YOU (PERSONALIZED) ========== -->
<section class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-purple-500 pl-3">Just For You</h2>
        <a href="#" class="text-purple-500 text-sm font-semibold">See More <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @php
            $justForYou = [
                ['name'=>'Noise Smart Watch','price'=>3990,'sold'=>1245,'img'=>'https://via.placeholder.com/200x200?text=Noise'],
                ['name'=>'Cotton Kurti','price'=>1199,'sold'=>892,'img'=>'https://via.placeholder.com/200x200?text=Kurti'],
                ['name'=>'USB-C Cable','price'=>299,'sold'=>3412,'img'=>'https://via.placeholder.com/200x200?text=Cable'],
                ['name'=>'Wireless Mouse','price'=>899,'sold'=>2231,'img'=>'https://via.placeholder.com/200x200?text=Mouse'],
                ['name'=>'Running Shoes','price'=>3590,'sold'=>521,'img'=>'https://via.placeholder.com/200x200?text=Shoes'],
                ['name'=>'Sunscreen SPF 50','price'=>450,'sold'=>892,'img'=>'https://via.placeholder.com/200x200?text=Sunscreen'],
            ];
        @endphp
        @foreach($justForYou as $item)
        <div class="bg-white rounded-xl p-3 shadow-sm hover:shadow-lg transition border border-gray-100 group">
            <div class="relative overflow-hidden rounded-md">
                <img src="{{ $item['img'] }}" class="w-full h-40 object-contain group-hover:scale-105 transition duration-300" alt="{{ $item['name'] }}">
            </div>
            <div class="mt-2">
                <h3 class="text-sm font-semibold text-gray-800 truncate">{{ $item['name'] }}</h3>
                <div class="text-red-600 font-bold">रु {{ number_format($item['price']) }}</div>
                <div class="text-xs text-gray-400"><i class="fas fa-chart-line"></i> {{ $item['sold'] }} sold</div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- ========== TOP VENDORS SECTION ========== -->
<section class="bg-purple-50 py-12 mt-8">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Top Stores on CartZen</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach(range(1,6) as $i)
            <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-md transition">
                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-purple-100 to-purple-50 rounded-full flex items-center justify-center text-3xl">
                    <i class="fas fa-store text-purple-500"></i>
                </div>
                <h4 class="font-bold mt-3 text-gray-800">Shop {{ $i }}</h4>
                <p class="text-xs text-gray-500">Verified Seller</p>
                <button class="mt-3 text-purple-500 text-sm font-medium">Visit Store</button>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========== CartZen APP DOWNLOAD BANNER ========== -->
<div class="max-w-7xl mx-auto px-8 lg:px-12">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="text-purple-600 text-center md:text-left">
            <h3 class="text-3xl font-bold">Download CartZen App!</h3>
            <p class="text-purple-600 mt-2">Get exclusive offers, faster checkout & easy returns</p>
        </div>
        <div class="flex gap-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" class="h-12" alt="Google Play">
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" class="h-12" alt="App Store">
        </div>
    </div>
</div>



<!-- Swiper JS & Timer Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper Carousel
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    });

    // Flash Sale Countdown Timer (Set end time to next 2 hours dynamic)
    function startFlashSaleTimer() {
        let endTime = new Date().getTime() + (2 * 60 * 60 * 1000); // 2 hours from now
        const hoursEl = document.getElementById('flashHours');
        const minutesEl = document.getElementById('flashMinutes');
        const secondsEl = document.getElementById('flashSeconds');

        const interval = setInterval(() => {
            let now = new Date().getTime();
            let distance = endTime - now;
            if (distance < 0) {
                clearInterval(interval);
                hoursEl.innerText = "00";
                minutesEl.innerText = "00";
                secondsEl.innerText = "00";
                return;
            }
            let hours = Math.floor((distance % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
            let minutes = Math.floor((distance % (60 * 60 * 1000)) / (60 * 1000));
            let seconds = Math.floor((distance % (60 * 1000)) / 1000);
            hoursEl.innerText = hours.toString().padStart(2, '0');
            minutesEl.innerText = minutes.toString().padStart(2, '0');
            secondsEl.innerText = seconds.toString().padStart(2, '0');
        }, 1000);
    }
    startFlashSaleTimer();
</script>
@endsection

{{-- @extends('layouts.app')

@section('title', 'Cartzen - Online Shopping Nepal')

@section('content')

    <!-- Hero Banner -->
    <section class="relative bg-gradient-to-br from-purple-900 via-indigo-900 to-purple-950 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-24 grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-5 py-2 rounded-3xl text-sm font-medium">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                    Nepal's Most Trusted Marketplace
                </div>

                <h1 class="text-5xl lg:text-6xl font-bold leading-tight tracking-tight">
                    Big Deals for a<br>Better Life
                </h1>

                <p class="text-2xl text-purple-100 font-light">
                    Up to <span class="font-bold text-white">60% OFF</span> on Premium Products
                </p>

                <div class="flex items-center gap-4">
                    <a href="{{ route('shop') }}"
                       class="inline-block bg-white text-purple-700 hover:bg-purple-50 px-10 py-4 rounded-2xl font-semibold text-lg transition-all duration-300 hover:scale-105 shadow-xl">
                        Shop Now
                    </a>
                    <a href="#"
                       class="inline-block border border-white/50 hover:border-white/80 px-8 py-4 rounded-2xl font-medium transition-all">
                        Browse Categories
                    </a>
                </div>

                <div class="flex items-center gap-8 text-sm pt-4">
                    <div class="flex items-center gap-2">
                        <i class="text-emerald-400">✔</i>
                        <span>Free Delivery</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="text-emerald-400">✔</i>
                        <span>Secure Payment</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="text-emerald-400">✔</i>
                        <span>1 Year Warranty</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center lg:justify-end">
                <img src="https://via.placeholder.com/620x520/4F46E5/FFFFFF?text=Premium+Collection"
                     class="rounded-3xl shadow-2xl w-full max-w-lg lg:max-w-none object-cover"
                     alt="Premium Products">
            </div>
        </div>

        <!-- Subtle background pattern -->
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff10_1px,transparent_1px)] [background-size:50px_50px] opacity-20 pointer-events-none"></div>
    </section>

    <!-- Flash Deals -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-4">
                <span class="text-4xl">⚡</span>
                <h2 class="text-4xl font-bold tracking-tight">Flash Deals</h2>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-gray-500 uppercase tracking-widest">Ends in</span>
                <div id="timer"
                     class="bg-red-600 text-white px-7 py-3 rounded-2xl font-mono text-2xl font-bold shadow-lg">
                    02:45:18
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach(range(1, 5) as $i)
                <x-product-card :discount="true" />
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="#" class="text-purple-600 hover:text-purple-700 font-semibold flex items-center justify-center gap-2">
                View All Flash Deals
                <span class="text-xl">→</span>
            </a>
        </div>
    </section>

    <!-- Top Categories -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Shop by Category</h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-6">
                @foreach($categories ?? [] as $category)
                    <a href="{{ route('category.show', $category->slug) }}"
                       class="group bg-white rounded-3xl p-6 text-center shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="text-5xl mb-4 transition-transform group-hover:scale-110">
                            {{ $category->emoji ?? '🛍️' }}
                        </div>
                        <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="flex justify-between items-end mb-10">
            <h2 class="text-3xl font-bold">Featured Products</h2>
            <a href="{{ route('shop') }}" class="text-purple-600 hover:underline font-medium">View All →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts ?? [] as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <!-- Top Vendors -->
    <section class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Trusted Vendors</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vendors ?? [] as $vendor)
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all group">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-purple-500 rounded-2xl flex items-center justify-center text-2xl">
                                🏪
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">{{ $vendor->shop_name }}</h3>
                                <p class="text-purple-300 text-sm">Verified Seller</p>
                            </div>
                        </div>
                        <a href="{{ route('vendor.store', $vendor->id) }}"
                           class="block text-center border border-white/30 hover:border-white py-3 rounded-2xl font-medium transition-colors">
                            Visit Store →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Flash Deal Timer
    let timeLeft = 45 * 60 + 18; // 45 minutes 18 seconds

    const timerEl = document.getElementById('timer');

    setInterval(() => {
        if (timeLeft <= 0) return;

        timeLeft--;
        const minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
        const seconds = (timeLeft % 60).toString().padStart(2, '0');

        timerEl.textContent = `${minutes}:${seconds}`;
    }, 1000);
</script>
@endpush --}}

{{-- @extends('layouts.app')

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
</div> --}}
