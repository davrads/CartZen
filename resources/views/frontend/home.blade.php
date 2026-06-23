@extends('layouts.app')

@section('title', 'CartZen | Online Shopping Nepal')

@section('content')

<!-- Custom Styles for CartZen Look -->
<style>
    /* Unified Primary Color Variables (Matches your Layout/Navbar) */
    :root {
        --primary-color: #7c3aed;
        /* Purple-600 */
        --primary-dark: #6d28d9;
        /* Purple-700 */
        --accent-color: #f59e0b;
        /* Amber-500 for Flash Sale */
    }

    .CartZen-gradient-bg {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    }

    .flash-badge {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        /* Red for urgency */
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .category-card {
        transition: all 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(124, 58, 237, 0.15);
        /* Purple shadow */
        border-color: var(--primary-color);
    }

    /* Swiper Navigation Customization */
    .swiper-button-next,
    .swiper-button-prev {
        color: #fff !important;
        background: rgba(0, 0, 0, 0.4) !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        backdrop-filter: blur(4px);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 18px !important;
        font-weight: bold;
    }

    .swiper-pagination-bullet-active {
        background-color: var(--primary-color) !important;
    }

    /* Timer Box Styling */
    .timer-box {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        padding: 8px 10px;
        border-radius: 8px;
        font-weight: 700;
        min-width: 45px;
        text-align: center;
        box-shadow: 0 4px 6px -1px rgba(124, 58, 237, 0.3);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="max-w-7xl mx-auto px-4 mt-6 mb-8">
    <div class="swiper mySwiper rounded-2xl overflow-hidden shadow-xl h-[250px] sm:h-[350px] md:h-[420px]">
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
        <div class="swiper-button-next hidden sm:block"></div>
        <div class="swiper-button-prev hidden sm:block"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<section class="max-w-7xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                <span class="text-3xl animate-bounce">⚡</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight">FLASH SALE</h2>
                <div class="flex items-center gap-2 ml-2 md:ml-4">
                    <div class="timer-box text-sm" id="flashHours">02</div>
                    <span class="text-2xl font-bold text-primary-600">:</span>
                    <div class="timer-box text-sm" id="flashMinutes">45</div>
                    <span class="text-2xl font-bold text-primary-600">:</span>
                    <div class="timer-box text-sm" id="flashSeconds">18</div>
                </div>
            </div>
            <a href="#" class="text-primary-600 font-semibold hover:text-primary-700 transition flex items-center gap-1">
                Shop More <i class="fas fa-angle-right"></i>
            </a>
        </div>

        <!-- Product Grid (Responsive: 2 cols mobile, up to 6 desktop) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
            @php
            $flashProducts = [
            ['name' => 'Smart Watch', 'price' => 2499, 'old' => 5999, 'img' => 'https://via.placeholder.com/200x200?text=Watch', 'discount' => '58%'],
            ['name' => 'Wireless Earbuds', 'price' => 1799, 'old' => 3999, 'img' => 'https://via.placeholder.com/200x200?text=Earbuds', 'discount' => '55%'],
            ['name' => 'Men Sneakers', 'price' => 2890, 'old' => 6990, 'img' => 'https://via.placeholder.com/200x200?text=Shoes', 'discount' => '58%'],
            ['name' => 'Backpack', 'price' => 1550, 'old' => 3200, 'img' => 'https://via.placeholder.com/200x200?text=Bag', 'discount' => '51%'],
            ['name' => 'T-Shirt', 'price' => 599, 'old' => 1499, 'img' => 'https://via.placeholder.com/200x200?text=Tshirt', 'discount' => '60%'],
            ['name' => 'Power Bank', 'price' => 1299, 'old' => 2999, 'img' => 'https://via.placeholder.com/200x200?text=PowerBank', 'discount' => '56%'],
            ];
            @endphp
            @foreach($flashProducts as $item)
            <div class="product-card group bg-white rounded-xl p-3 text-center hover:shadow-lg transition duration-300 border border-gray-100">
                <div class="relative overflow-hidden rounded-lg bg-gray-50">
                    <img src="{{ $item['img'] }}" class="product-image w-full h-32 sm:h-40 object-contain transition-transform duration-300 mx-auto p-2" alt="{{ $item['name'] }}">
                    <div class="absolute top-2 left-2 flash-badge text-white text-[10px] sm:text-xs px-2 py-0.5 rounded-full font-bold shadow-sm">{{ $item['discount'] }} OFF</div>
                </div>
                <h3 class="font-semibold text-gray-700 text-xs sm:text-sm mt-2 line-clamp-2 h-10">{{ $item['name'] }}</h3>
                <div class="text-primary-600 font-bold text-base sm:text-lg mt-1">रु {{ number_format($item['price']) }}</div>
                <div class="text-gray-400 text-[10px] sm:text-xs line-through">रु {{ number_format($item['old']) }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>



<section class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">
        Featured Products
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featuredProducts as $product)
        <x-product-card :product="$product" />
        @endforeach
    </div>
</section>
<section class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6 relative group w-full">
        <h2 class="text-2xl font-bold mb-6 sm:mb-0 text-gray-800 border-l-4 border-primary-600 pl-3">Shop by Category</h2>

        <a href="{{route('categories.index')}}" class="flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition shadow-sm w-full sm:w-auto justify-center sm:justify-start">
            <span class="font-medium">All Categories</span>
        </a>
    </div>
    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">

        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category) }}" class="category-card bg-white rounded-2xl p-3 sm:p-4 text-center shadow-sm hover:shadow-md transition-all border border-gray-100 h-32 sm:h-36 flex flex-col items-center justify-center">{{$category->name}}
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full flex items-center justify-center text-xl sm:text-2xl mb-2 sm:mb-3">
                <img src="{{asset('storage/'.$category->image)}}" alt="{{ $category->name }}">
            </div>
            <span class="text-[10px] sm:text-xs font-medium text-gray-700">{{ $category->name }}</span>
        </a>
        @endforeach
    </div>
</section>

<section class="bg-purple-50 py-12 mt-8">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Top Stores on CartZen</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
            @foreach(range(1,6) as $i)
            <div class="bg-white rounded-xl p-4 text-center shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center text-2xl sm:text-3xl mb-3">
                    <i class="fas fa-store text-primary-600"></i>
                </div>
                <h4 class="font-bold mt-2 text-sm sm:text-base text-gray-800">Shop {{ $i }}</h4>
                <p class="text-[10px] sm:text-xs text-gray-500 mb-3">Verified Seller</p>
                <a href="/vendor-store" class="w-full py-1.5 text-xs sm:text-sm font-medium text-primary-600 bg-primary-50 rounded-lg hover:bg-primary-100 transition">
                    Visit Store
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-3xl p-6 md:p-10 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="text-center md:text-left space-y-2">
            <h3 class="text-2xl md:text-4xl font-bold">Download CartZen App!</h3>
            <p class="text-primary-100 text-sm md:text-lg">Get exclusive offers, faster checkout & easy returns</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto justify-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" class="h-10 md:h-12 w-auto cursor-pointer hover:opacity-90 transition" alt="Google Play">
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" class="h-10 md:h-12 w-auto cursor-pointer hover:opacity-90 transition" alt="App Store">
        </div>
    </div>
</div>

<div class="h-10"></div>

@endsection

@push('scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Initialize Swiper Carousel
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            // Mobile
            320: {
                spaceBetween: 10,
                height: 250,
            },
            // Tablet
            640: {
                spaceBetween: 20,
                height: 350,
            },
            // Desktop
            768: {
                spaceBetween: 30,
                height: 420,
            },
        },
    });

    // Flash Sale Countdown Timer
    function startFlashSaleTimer() {
        // Set timer to 2 hours from now for demo purposes
        let endTime = new Date().getTime() + (2 * 60 * 60 * 1000);

        const hoursEl = document.getElementById('flashHours');
        const minutesEl = document.getElementById('flashMinutes');
        const secondsEl = document.getElementById('flashSeconds');

        if (!hoursEl || !minutesEl || !secondsEl) return;

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

    // Start timer when DOM is ready
    document.addEventListener('DOMContentLoaded', startFlashSaleTimer);
</script>
@endpush