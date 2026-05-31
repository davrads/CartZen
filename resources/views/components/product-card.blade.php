
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="w-full lg:w-1/3 flex flex-col-reverse lg:flex-row gap-4">
                <div class="flex lg:flex-col gap-3 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0">
                    <div class="h-16 w-16 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-sky-600 cursor-pointer transition-all">
                        <img class="h-full w-full object-cover" src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" alt="Thumb 1">
                    </div>
                    <div class="h-16 w-16 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-sky-600 cursor-pointer transition-all">
                        <img class="h-full w-full object-cover" src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" alt="Thumb 2">
                    </div>
                    <div class="h-16 w-16 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-sky-600 cursor-pointer transition-all">
                        <img class="h-full w-full object-cover" src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" alt="Thumb 3">
                    </div>
                    <div class="h-16 w-16 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-sky-600 cursor-pointer transition-all">
                        <img class="h-full w-full object-cover" src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" alt="Thumb 4">
                    </div>
                </div>
                <div class="w-full flex-1">
                    <div class="aspect-square w-full rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-white">
                        <img class="h-full w-full object-cover" src="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif" alt="Main Product">
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 flex flex-col gap-6">

                <div class="border-b border-gray-200 pb-4">
                    <div class="flex flex-wrap items-center gap-3 mb-2">
                        <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded">-10%</span>
                        <h1 class="text-2xl font-bold text-gray-900">Iphone All Series Phone</h1>
                    </div>

                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <div class="flex items-center text-yellow-400">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                            </svg>
                            <span class="text-gray-700 font-medium ml-1">4.5</span>
                        </div>
                        <span class="text-gray-400">|</span>
                        <span>128 Reviews</span>
                        <span class="text-gray-400">|</span>
                        <span>256 Sold</span>
                    </div>
                </div>

                <div class="flex flex-wrap items-end gap-4">
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-red-600">Rs.18,999</span>
                        <span class="text-lg text-gray-400 line-through">Rs.22,000</span>
                    </div>
                    <span class="text-green-600 text-sm font-medium bg-green-50 px-2 py-1 rounded">In Stock</span>
                </div>

                <div class="text-sm text-gray-500 space-y-1">
                    <p><span class="font-semibold text-gray-700">Brand:</span> Apple</p>
                    <p><span class="font-semibold text-gray-700">SKU:</span> Iphone 14 Pro</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Select Color</h3>
                    <div class="flex flex-wrap gap-3">
                        <button class="h-8 w-8 rounded-full bg-black border-2 border-transparent hover:border-sky-600 focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-all"></button>
                        <button class="h-8 w-8 rounded-full bg-sky-600 border-2 border-transparent hover:border-sky-800 focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-all"></button>
                        <button class="h-8 w-8 rounded-full bg-gray-600 border-2 border-transparent hover:border-sky-600 focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-all"></button>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Select Storage</h3>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" class="px-4 py-2 border-2 border-sky-600 text-sky-600 font-medium rounded-lg bg-sky-50 hover:bg-sky-100 transition-colors">
                            4/128GB
                        </button>
                        <button type="button" class="px-4 py-2 border-2 border-gray-200 text-gray-600 font-medium rounded-lg hover:border-sky-600 hover:text-sky-600 transition-colors">
                            6/128GB
                        </button>
                        <button type="button" class="px-4 py-2 border-2 border-gray-200 text-gray-600 font-medium rounded-lg hover:border-sky-600 hover:text-sky-600 transition-colors">
                            8/256GB
                        </button>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Quantity</h3>
                    <div class="flex items-center w-32 border border-gray-300 rounded-lg overflow-hidden">
                        <button type="button" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors border-r border-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <input type="number" value="1" min="1" class="w-12 h-10 text-center text-sm font-semibold text-gray-800 border-none focus:ring-0 bg-white" readonly>
                        <button type="button" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors border-l border-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-200">
        
                    <button type="button" class="flex-1 bg-white text-sky-600 font-bold py-3 px-6 rounded-lg border-2 border-sky-600 hover:bg-sky-50 transition-colors shadow-sm">
                        Add to Cart
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div class="space-y-2 text-gray-700">
    <p class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span><strong>Stunning Display:</strong> 6.1" Super Retina XDR OLED with ProMotion 120Hz for ultra-smooth scrolling.</span>
    </p>
    <p class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span><strong>Pro Camera System:</strong> 48MP Main, 12MP Ultra Wide, and 12MP Telephoto with 3x Optical Zoom.</span>
    </p>
    <p class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span><strong>Powerhouse Performance:</strong> A16 Bionic chip delivers incredible speed for gaming and multitasking.</span>
    </p>
    <p class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span><strong>All-Day Battery:</strong> Up to 26 hours video playback with fast charging and MagSafe support.</span>
    </p>
    <p class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span><strong>Ceramic Shield:</strong> Tougher than any smartphone glass with water resistance up to 6 meters.</span>
    </p>
</div>
@endsection