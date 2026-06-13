@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gray-50 flex">

    <div class="hidden lg:flex lg:w-1/2 hero-bg items-center justify-center p-12 relative overflow-hidden">
        <!-- Decorative Circles -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full translate-x-1/3 translate-y-1/3"></div>

        <div class="relative z-10 text-center text-white max-w-lg">
            <h1 class="text-5xl font-bold mb-6">Welcome Back to Cartzen</h1>
            <p class="text-lg text-purple-100 mb-8">
                Access your account to track orders, manage your wishlist, and enjoy exclusive deals.
            </p>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                    <div class="text-2xl font-bold mb-1">10k+</div>
                    <div class="text-sm text-purple-100">Products</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                    <div class="text-2xl font-bold mb-1">24/7</div>
                    <div class="text-sm text-purple-100">Support</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                    <div class="text-2xl font-bold mb-1">Free</div>
                    <div class="text-sm text-purple-100">Shipping</div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md space-y-8">
            <div class="lg:hidden text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Cartzen</h2>
                <p class="text-gray-500 mt-2">Sign in to continue</p>
            </div>

            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-bold text-gray-900">Sign in to your account</h2>
                <p class="mt-2 text-sm text-gray-600">
                    New to Cartzen?
                    <a href="/register" class="font-medium text-primary hover:text-purple-700 transition">Create an account</a>
                </p>
            </div>

            <form action="/login" method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary sm:text-sm transition"
                                placeholder="you@example.com">
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary sm:text-sm transition"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me for 30 days</label>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 
                        border border-transparent text-sm font-medium rounded-lg 
                        text-white bg-primary hover:bg-purple-700 focus:outline-none 
                        focus:ring-2 focus:ring-offset-2 focus:ring-primary transition shadow-lg hover:shadow-xl transform 
                        hover:-translate-y-0.5">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <a href="{{route('google.login')}}"
                        class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        <i class="fab fa-google text-red-500 mr-2"></i> Google
                    </a>
                    <button type="button"
                        class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i> Facebook
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection