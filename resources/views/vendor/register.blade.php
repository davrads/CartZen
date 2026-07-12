@extends('layouts.app')

@section('title', 'Become a Seller | CartZen')

@section('content')

<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row">
        
        <div class="w-full lg:w-2/5 bg-gradient-to-br from-purple-700 to-indigo-800 p-8 lg:p-12 text-white relative overflow-hidden">
            <!-- Decorative Circle Background -->
            <div class="absolute -top-24 -left-24 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-indigo-600 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>

            <div class="relative z-10 flex flex-col h-full justify-between">
                <div>
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                        Become a Seller<br>
                        <span class="text-purple-200">with CartZen</span> 

                    </h1>
                    <p class="text-lg text-purple-100 mb-8">
                        Join our marketplace and grow your business today.
                    </p>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-300 mt-1"></i>
                            <span>Reach thousands of customers</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-300 mt-1"></i>
                            <span>Secure payment system</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-300 mt-1"></i>
                            <span>Easy product management</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-300 mt-1"></i>
                            <span>Dedicated vendor dashboard</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 relative">
                    <img 
                        src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                        alt="Shop Interior" 
                        class="rounded-2xl shadow-lg border-4 border-white/20 w-full object-cover h-64 lg:h-80"
                    >
                    <div class="absolute bottom-4 left-4 right-4 bg-white/10 backdrop-blur-md p-3 rounded-lg border border-white/20">
                        <p class="text-sm font-medium text-center">Start your journey with us</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-3/5 p-8 lg:p-12 bg-white overflow-y-auto">
            <div class="max-w-2xl mx-auto">
                
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Seller Request Form</h2>
                    <p class="text-gray-500">Please complete the application. Our team will review it within 24 hours.</p>
                </div>

                <form action="{{ route('vendor.request.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-gray-700 mb-1">Owner Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="owner_name" id="owner_name" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"
                                placeholder="Enter your full name">
                        </div>
                    </div>

                    <div>
                        <label for="shop_name" class="block text-sm font-medium text-gray-700 mb-1">Shop Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-store text-gray-400"></i>
                            </div>
                            <input type="text" name="shop_name" id="shop_name" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"
                                placeholder="Enter your shop name">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Shop Logo</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-purple-400 transition-colors bg-gray-50 group cursor-pointer">
                            <div class="space-y-1 text-center">
                                <div class="mx-auto h-12 w-12 text-gray-400 group-hover:text-purple-500 transition-colors">
                                    <i class="fas fa-cloud-upload-alt text-4xl"></i>
                                </div>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="shop_logo" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none">
                                        <span>+ Upload Shop Logo</span>
                                        <input id="shop_logo" name="shop_logo" type="file" class="sr-only" accept="image/png, image/jpeg">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG up to 5MB</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="3" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"
                            placeholder="Describe your business, products, and unique selling points..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" name="phone" id="phone" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"
                                placeholder="+977 9800000000">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"
                                placeholder="you@example.com">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea id="address" name="address" rows="2" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"
                            placeholder="Full shop address..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PAN Proof (PAN Card)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-purple-400 transition-colors bg-gray-50 group cursor-pointer">
                            <div class="space-y-1 text-center">
                                <div class="mx-auto h-12 w-12 text-gray-400 group-hover:text-purple-500 transition-colors">
                                    <i class="fas fa-file-upload text-4xl"></i>
                                </div>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="pan_card" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none">
                                        <span>Upload PAN Card</span>
                                        <input id="pan_card" name="pan_card" type="file" class="sr-only" accept="image/png, image/jpeg, application/pdf">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 5MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="certification" name="certification" type="checkbox" required
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="certification" class="font-medium text-gray-700">I certify that all information provided is correct.</label>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" 
                            class="w-full flex justify-center items-center gap-2 py-4 px-4 border border-transparent rounded-xl shadow-sm text-base font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all transform hover:scale-[1.01]">
                            Submit Application
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection