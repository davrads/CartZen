<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartzen - Multi Vendor Ecommerce</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="min-h-screen flex flex-col bg-gray-50 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="h-20 flex items-center justify-between">

                <a href="{{ route('home') }}"
                   class="text-3xl font-bold text-purple-600">
                    Cartzen
                </a>

                <div class="flex items-center gap-8">

                    <a href="{{ route('products.index') }}"
                       class="text-gray-700 font-medium hover:text-purple-600 transition">
                        Shop
                    </a>

                    <a href="{{ route('cart.index') }}"
                       class="text-gray-700 font-medium hover:text-purple-600 transition">
                        Cart
                    </a>

                    @auth
                        <div class="relative group">

                            <button class="text-gray-700 font-medium">
                                {{ Auth::user()->name }}
                            </button>

                            {{-- <div class="absolute right-0 hidden group-hover:block bg-white shadow-lg rounded-lg mt-2 z-20 min-w-[220px]"> --}}
                                <div class="absolute right-0 top-full hidden group-hover:block bg-white shadow-lg rounded-lg z-20 min-w-[220px]">
                                <a href="{{ route('dashboard') }}"
                                   class="block px-5 py-3 text-sm hover:bg-gray-50">
                                    Dashboard
                                </a>

                                @if(Auth::user()->isVendor())
                                    <a href="{{ route('vendor.dashboard') }}"
                                       class="block px-5 py-3 text-sm hover:bg-gray-50">
                                        Vendor Panel
                                    </a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left px-5 py-3 text-sm hover:bg-gray-50">
                                        Logout
                                    </button>
                                </form>

                            </div>
                        </div>
                    @else

                        @if(Route::has('login'))
                            <a href="{{ route('login') }}"
                               class="text-gray-700 font-medium hover:text-purple-600">
                                Login
                            </a>
                        @endif

                        @if(Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="text-gray-700 font-medium hover:text-purple-600">
                                Register
                            </a>
                        @endif

                    @endauth

                </div>

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-10 py-8">

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-lg bg-red-100 text-red-800 px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </div>
    </main>

    @include('layouts.footer')

</body>
</html>