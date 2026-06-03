@extends('layouts.app')

@section('title', 'Samsung Galaxy A14 - Cartzen')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex flex-col lg:flex-row gap-10">
        
        <!-- Image Gallery -->
        <div class="w-full lg:w-2/5">
            <div class="flex flex-col-reverse lg:flex-row gap-4">
                
                <!-- Thumbnails -->
                <div class="flex lg:flex-col gap-3 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0">
                    <div class="h-20 w-20 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-purple-600 cursor-pointer transition-all">
                        <img class="h-full w-full object-cover" 
                             src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" 
                             alt="Thumb 1">
                    </div>
                    <div class="h-20 w-20 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-purple-600 cursor-pointer transition-all">
                        <img class="h-full w-full object-cover" 
                             src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" 
                             alt="Thumb 2">
                    </div>
                    <div class="h-20 w-20 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-purple-600 cursor-pointer transition-all">
                        <img class="h-full w-full object-cover" 
                             src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" 
                             alt="Thumb 3">
                    </div>
                    <div class="h-20 w-20 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-purple-600 cursor-pointer transition-all">
                        <img class="h-full w-full object-cover" 
                             src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" 
                             alt="Thumb 4">
                    </div>
                </div>

                <!-- Main Image -->
                <div class="flex-1">
                    <div class="aspect-square w-full rounded-3xl overflow-hidden shadow-xl border border-gray-100 bg-white">
                        <img class="h-full w-full object-cover" 
                             src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" 
                             alt="Main Product">
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Information -->
        <div class="w-full lg:w-3/5 flex flex-col gap-6">
            
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">-10%</span>
                    <h1 class="text-3xl font-bold text-gray-900">iPhone All Series Phone</h1>
                </div>

                <div class="flex items-center gap-4 text-sm">
                    <div class="flex items-center text-yellow-400">
                        ★★★★☆
                        <span class="ml-2 text-gray-700 font-medium">4.5</span>
                    </div>
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-600">128 Reviews</span>
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-600">2.5k+ Sold</span>
                </div>
            </div>

            <!-- Price -->
            <div class="flex items-end gap-4">
                <span class="text-4xl font-bold primary-purple">Rs. 18,999</span>
                <span class="text-xl text-gray-400 line-through">Rs. 22,000</span>
                <span class="bg-green-100 text-green-700 text-sm font-medium px-3 py-1 rounded-xl">In Stock</span>
            </div>

            <!-- Basic Info -->
            <div class="text-sm text-gray-600 space-y-1">
                <p><span class="font-semibold text-gray-800">Brand:</span> Apple</p>
                <p><span class="font-semibold text-gray-800">SKU:</span> IP14PRO-128</p>
            </div>

            <!-- Color Selection -->
            <div>
                <h3 class="text-sm font-semibold text-gray-800 mb-3">Select Color</h3>
                <div class="flex gap-4">
                    <button class="h-9 w-9 rounded-full bg-black border-2 border-purple-600 ring-2 ring-offset-2 ring-purple-200"></button>
                    <button class="h-9 w-9 rounded-full bg-sky-600 border-2 border-transparent hover:border-purple-600"></button>
                    <button class="h-9 w-9 rounded-full bg-gray-400 border-2 border-transparent hover:border-purple-600"></button>
                </div>
            </div>

            <!-- Storage Selection -->
            <div>
                <h3 class="text-sm font-semibold text-gray-800 mb-3">Select Storage</h3>
                <div class="flex flex-wrap gap-3">
                    <button class="px-5 py-2.5 border-2 border-purple-600 text-purple-600 font-medium rounded-2xl bg-purple-50">4/128GB</button>
                    <button class="px-5 py-2.5 border-2 border-gray-200 text-gray-700 font-medium rounded-2xl hover:border-purple-600 hover:text-purple-600 transition">6/128GB</button>
                    <button class="px-5 py-2.5 border-2 border-gray-200 text-gray-700 font-medium rounded-2xl hover:border-purple-600 hover:text-purple-600 transition">8/256GB</button>
                </div>
            </div>

            <!-- Quantity -->
            <div>
                <h3 class="text-sm font-semibold text-gray-800 mb-3">Quantity</h3>
                <div class="flex items-center w-36 border border-gray-300 rounded-2xl overflow-hidden">
                    <button class="w-12 h-12 flex items-center justify-center text-xl font-light hover:bg-gray-100">-</button>
                    <input type="number" value="1" min="1" 
                           class="w-14 h-12 text-center text-lg font-semibold focus:outline-none">
                    <button class="w-12 h-12 flex items-center justify-center text-xl font-light hover:bg-gray-100">+</button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <button onclick="addToCart()" 
                        class="flex-1 bg-primary hover:bg-purple-700 text-white font-semibold py-4 rounded-3xl transition text-lg">
                    Add to Cart
                </button>
                <button class="flex-1 bg-gray-900 hover:bg-black text-white font-semibold py-4 rounded-3xl transition text-lg">
                    Buy Now
                </button>
            </div>

        </div>
    </div>

    <!-- Product Highlights -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold mb-6">Product Highlights</h2>
        <div class="grid md:grid-cols-2 gap-6 text-gray-700">
            <p class="flex items-start gap-3">
                <span class="text-green-500 mt-1">✔</span>
                <span><strong>Stunning Display:</strong> 6.1" Super Retina XDR OLED with ProMotion 120Hz.</span>
            </p>
            <p class="flex items-start gap-3">
                <span class="text-green-500 mt-1">✔</span>
                <span><strong>Pro Camera System:</strong> 48MP Main with advanced photography features.</span>
            </p>
            <p class="flex items-start gap-3">
                <span class="text-green-500 mt-1">✔</span>
                <span><strong>Powerful Performance:</strong> A16 Bionic chip for smooth multitasking.</span>
            </p>
            <p class="flex items-start gap-3">
                <span class="text-green-500 mt-1">✔</span>
                <span><strong>All-Day Battery:</strong> Up to 26 hours video playback with fast charging.</span>
            </p>
        </div>
    </div>
</div>
@endsection