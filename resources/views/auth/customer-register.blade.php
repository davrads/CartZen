@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-7xl">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">
            <div class="hidden lg:flex hero-bg items-center justify-center p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white opacity-10 rounded-full -translate-x-1/3 translate-y-1/3"></div>

                <div class="relative z-10 text-center text-white max-w-lg">
                    <h1 class="text-5xl font-bold mb-6">Join the Cartzen Community</h1>
                    <p class="text-lg text-purple-100 mb-8">
                        Get access to exclusive deals, early access to flash sales, and a smoother shopping experience.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl text-center">
                            <i class="fas fa-shield-alt text-3xl mb-2"></i>
                            <div class="text-sm font-medium">Secure Checkout</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl text-center">
                            <i class="fas fa-truck text-3xl mb-2"></i>
                            <div class="text-sm font-medium">Fast Delivery</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center p-8 sm:p-12">
                <div class="w-full max-w-md space-y-8">
                    <div class="lg:hidden text-center mb-6">
                        <h2 class="text-3xl font-bold text-gray-900">Cartzen</h2>
                        <p class="text-gray-500 mt-2">Create your account</p>
                    </div>

                    <div class="text-center lg:text-left">
                        <h2 class="text-3xl font-bold text-gray-900">Create your Cartzen account</h2>
                        <p class="mt-2 text-sm text-gray-600">
                            Already have an account?
                            <a href="/login" class="font-medium text-primary hover:text-purple-700 transition">Sign in</a>
                        </p>
                    </div>

                    <form action="/register" method="POST" class="mt-8 space-y-6">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input id="name" name="name" type="text" autocomplete="name" required
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary sm:text-sm transition"
                                        placeholder="Enter your name">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary sm:text-sm transition"
                                        placeholder="Enter your email">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                        <input id="password" name="password" type="password" autocomplete="new-password" required
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary sm:text-sm transition"
                                            placeholder="••••••••">
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Min. 8 characters</p>
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-check-circle text-gray-400"></i>
                                        </div>
                                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary sm:text-sm transition"
                                            placeholder="••••••••">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" required
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="text-gray-700">
                                    I agree to the <a href="#" class="text-primary hover:text-purple-700">Terms</a> and <a href="#" class="text-primary hover:text-purple-700">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Create Account
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or register with</span>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a href="{{route('google.register')}}" class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                <i class="fab fa-google text-red-500 mr-2"></i> Google
                            </a>
                            <button type="button" class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                <i class="fab fa-facebook text-blue-600 mr-2"></i> Facebook
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection