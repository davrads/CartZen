@extends('layouts.app')

@section('title', 'CartZen | Online Shopping Nepal')

@section('content')
{{-- Success Alert --}}
@if(session('success'))
<div id="success-alert" class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-100 shadow-xl transition-all duration-500 max-w-sm sm:max-w-md animate-fade-in">
    <svg class="flex-shrink-0 w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
    <div class="ml-3 text-sm font-semibold tracking-wide pr-4">
        {{ session('success') }}
    </div>
    <button type="button" onclick="document.getElementById('success-alert').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex h-8 w-8 transition-colors">
        <span class="sr-only">Close</span>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
@endif
>

<style>
    :root {
        --primary: #7c3aed;
        --primary-dark: #6d28d9;
        --accent: #f59e0b;
    }

    /* Background gradient animation */
    @keyframes gradient-shift {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .animate-gradient-shift {
        background-size: 200% 200%;
        animation: gradient-shift 8s ease infinite;
    }

    /* Floating items animation */
    @keyframes float {
        0% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-15px) rotate(5deg);
        }

        100% {
            transform: translateY(0px) rotate(0deg);
        }
    }

    .floating-item {
        animation: float 6s ease-in-out infinite;
        filter: brightness(0) invert(1);
        /* makes them white silhouettes */
        opacity: 0.6;
    }

    .floating-item:nth-child(odd) {
        animation-duration: 7s;
    }

    .floating-item:nth-child(even) {
        animation-duration: 5s;
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
        box-shadow: 0 4px 10px rgba(124, 58, 237, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #fff !important;
        background: rgba(0, 0, 0, 0.4) !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        backdrop-filter: blur(6px);
        transition: all 0.2s;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: rgba(0, 0, 0, 0.6) !important;
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
        background: #f9fafb;
        border: 1px solid #e5e7eb;
    }

    .store-icon {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
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

{{-- FLASH SALE SECTION --}}
<section class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="flex items-center gap-2 text-3xl font-bold text-gray-900 ">
                <i class="fa-solid fa-bolt text-orange-500"></i>
                Flash Deals
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Limited time offers. Grab them now!
            </p>
        </div>
        <a href="{{ route('shop-on-sale') }}" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:border-violet-500 hover:text-violet-600 hover:shadow-sm">View All
            <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
    </div>
    <div class="rounded-2-xl bg-white p-6 shadow-sm border border-gray-100">

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @if(isset($flashSales) && $flashSales->count())
            @foreach($flashSales as $flashSale)
            <x-flash-product-card :flashSale="$flashSale" />
            @endforeach
            @else
            <div>
                <p class="text-gray-600">No flash sales available.</p>
                @endif
            </div>
        </div>
    </div>

</section>



{{-- JUST FOR YOU (All Products)  --}}
<section class="max-w-7xl mx-auto px-4 pb-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="flex items-center gap-2 text-3xl font-bold text-gray-900">
                <i class="fas fa-cart-shopping text-black"></i>
                Our Products
            </h2>
            <p class="mt-1 text-gray-500">Discover all our products.</p>
        </div>

        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:border-violet-500 hover:text-violet-600 hover:shadow-sm">
            View All
            <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
    </div>

    <div class="bg-white border border-gray-200 p-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5 md:gap-6">

        @if(isset($justForYouProducts) && $justForYouProducts->count())
        @foreach($justForYouProducts as $product)

        <div class="flex flex-col h-full">
            <x-product-card :product="$product" />
        </div>
        @endforeach
        @else
        {{-- Empty State --}}
        <div class="col-span-full rounded-2xl border border-dashed border-gray-200 bg-white py-20 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900">No products available</h3>
            <p class="text-gray-500 mt-1">Check back later for new arrivals!</p>
        </div>
        @endif

    </div>

    {{-- Pagination Links (Only if using Paginate) --}}
    @if(isset($justForYouProducts) && method_exists($justForYouProducts, 'links'))
    <div class="mt-16 flex justify-center">
        {{ $justForYouProducts->links() }}
    </div>
    @endif

</section>


{{-- SHOP BY CATEGORY --}}
<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="flex items-center gap-2 text-2xl md:text-3xl font-bold text-gray-900">
                <i class="fas fa-tags text-black"></i>
                Shop by Category
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Discover our complete collection.
            </p>
        </div>
        <a href="{{ route('categories.index') }}"
            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition-all hover:border-violet-500 hover:text-violet-600 hover:shadow-sm">
            View All
            <i class="fas fa-arrow-right text-xs"></i>
        </a>
    </div>
    <div class="grid grid-cols-2 bg-white border border-gray-200 p-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-5">

        @forelse($categories as $category)

        <a href="{{ route('categories.show', $category) }}"
            class="group bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-1 hover:border-violet-300 transition-all duration-300 p-5 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center overflow-hidden transition-transform duration-300 group-hover:scale-105">
                <img
                    src="{{ $category->image ? asset('storage/'.$category->image) : 'https://loremflickr.com/80/80/'.urlencode($category->name).'?random='.$category->id }}"
                    alt="{{ $category->name }}"
                    class="w-full h-full object-cover rounded-full"
                    onerror="this.onerror=null;this.src='https://placehold.co/80x80/F3F4F6/7C3AED?text={{ urlencode(substr($category->name,0,1)) }}';">

            </div>
            <h3 class="mt-4 text-sm font-semibold text-gray-800 line-clamp-2 group-hover:text-violet-600 transition-colors">
                {{ $category->name }}
            </h3>
        </a>
        @empty
        <div class="col-span-full rounded-2xl border border-dashed border-gray-200 py-16 text-center">
            <i class="fas fa-tags text-5xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-900">
                No Categories Available
            </h3>
            <p class="text-gray-500 mt-2">
                Categories will appear here once they are added.
            </p>
        </div>
        @endforelse
    </div>
</section>

{{-- TOP STORES --}}
<section class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="flex items-center gap-2 text-3xl font-bold text-gray-900">
                <i class="fas fa-store text-black"></i>
                Top Stores
            </h2>
            <p class="mt-1 text-gray-500">
                Discover trusted and verified stores on CartZen.
            </p>
        </div>

        <a href="{{ route('stores.index') }}"
            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:border-violet-500 hover:text-violet-600 hover:shadow-sm">
            View All
            <i class="fas fa-arrow-right text-xs"></i>
        </a>
    </div>
    <div class="bg-white border border-gray-200  shadow-sm p-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
            @foreach($stores as $store)

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 text-center transition-all duration-300 hover:-translate-y-1 hover:border-violet-300 hover:shadow-md">
                <div class="w-20 h-20 mx-auto rounded-full overflow-hidden border border-gray-200 bg-gray-50">
                    @if($store->shop_logo)
                    <img
                        src="{{ Storage::url($store->shop_logo) }}"
                        alt="{{ $store->shop_name }}"
                        class="w-full h-full object-cover">
                    @else
                    <img
                        src="https://loremflickr.com/80/80/store?random={{ $store->id }}"
                        alt="{{ $store->shop_name }}"
                        class="w-full h-full object-cover">
                    @endif
                </div>
                <h3 class="mt-4 font-semibold text-gray-900 line-clamp-1">
                    {{ $store->shop_name }}
                </h3>
                <p class="mt-1 text-xs text-gray-500">
                    {{ $store->user->products()->count() }} Products
                </p>
                <div class="mt-2 flex items-center justify-center gap-1 text-xs text-green-600">
                    <i class="fas fa-check-circle"></i>
                    Verified Seller
                </div>
                <a href="{{ route('stores.show', $store) }}"
                    class="mt-4 inline-flex items-center justify-center w-full rounded-lg bg-violet-50 px-4 py-2 text-sm font-medium text-violet-700 transition hover:bg-violet-100">
                    Visit Store
                </a>
            </div>
            @endforeach
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
            320: {
                spaceBetween: 10,
                height: 250
            },
            640: {
                spaceBetween: 20,
                height: 350
            },
            768: {
                spaceBetween: 30,
                height: 420
            },
        },
    });

    document.addEventListener('alpine:init', () => {
        Alpine.data('flashCountdown', (endDate) => ({
            end: new Date(endDate).getTime(),
            time: {
                hours: '00',
                minutes: '00',
                seconds: '00'
            },
            init() {
                this.updateTime();
                setInterval(() => this.updateTime(), 1000);
            },
            updateTime() {
                const now = Date.now();
                let diff = this.end - now;
                if (diff <= 0) {
                    this.time = {
                        hours: '00',
                        minutes: '00',
                        seconds: '00'
                    };
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