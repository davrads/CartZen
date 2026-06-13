<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-8 lg:px-12">
        <div class="grid grid-cols-3 items-center h-24">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img
                        class="h-[80px] w-auto"
                        src="frontend/images/cartzen_logo.png"
                        alt="CartZen Logo"
                    >
                </a>
            </div>

            <!-- Center Navigation -->
            <div class="hidden md:flex justify-center items-center gap-10">
                <a
                    href="{{ route('home') }}"
                    class="text-gray-700 hover:text-purple-600 font-medium transition duration-200"
                >
                    Home
                </a>

                <a
                    href="{{ route('shop', ['slug' => 'mobiles-tablets']) }}"
                    class="text-gray-700 hover:text-purple-600 font-medium transition duration-200"
                >
                    Shop
                </a>

                <a
                    href="{{ route('cart.index') }}"
                    class="text-gray-700 hover:text-purple-600 font-medium transition duration-200"
                >
                    Cart
                </a>
            </div>

            <!-- Right Section -->
            <div class="flex justify-end items-center gap-4">

                {{-- @auth
                    @if(auth()->user()->role == 'vendor')
                        <a href="{{ route('vendor.dashboard') }}"
                           class="text-gray-700 hover:text-purple-600 font-medium">
                            Dashboard
                        </a>
                    @endif

                    @if(auth()->user()->role == 'admin')
                        <a href="/admin"
                           class="text-gray-700 hover:text-purple-600 font-medium">
                            Admin
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-purple-600 font-medium">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 transition">
                        Register
                    </a>
                @endauth --}}
                
            </div>

        </div>
    </div>
</nav>

<!-- ========== CartZen STYLE HEADER ========== -->
    <div class="bg-white border-b shadow-sm sticky top-0 z-50">
    <!-- Top Bar -->
    <div class="bg-purple-50 border-b border-purple-100 hidden md:block">
    <div class="max-w-7xl mx-auto px-6 py-2 flex justify-between items-center text-sm">

        <div class="flex items-center gap-6 text-gray-600">
            <a href="#" class="hover:text-purple-600 transition">
                Nepal
            </a>

            <a href="#" class="hover:text-purple-600 transition">
                Seller Center
            </a>

            <a href="#" class="hover:text-purple-600 transition">
                Download App
            </a>
        </div>

        <div class="flex items-center gap-6">
            <a href="#" class="hover:text-purple-600 transition">
                Notifications
            </a>

            <a href="#" class="hover:text-purple-600 transition">
                Help
            </a>

            <a href="#" class="hover:text-purple-600 transition">
                Register
            </a>

            <a href="#"
                class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                Login
            </a>
        </div>

    </div>
</div>

    <!-- Main Header -->
    <div class="max-w-7xl mx-auto px-4 py-3 flex flex-wrap items-center gap-4">
        <!-- Search Bar with Category Dropdown -->
        <div class="flex-1 min-w-[200px] flex shadow-sm border border-gray-300 rounded-md overflow-hidden bg-white">
            <div class="relative group">
                <button class="flex items-center gap-1 px-4 py-3 bg-gray-50 text-gray-700 text-sm border-r hover:bg-gray-100">
                    All Categories <i class="fas fa-chevron-down text-[10px] ml-1"></i>
                </button>
                <div class="absolute hidden group-hover:block bg-white shadow-lg w-56 z-20 border mt-1 rounded">
                    <ul class="text-sm">
                        <li class="px-4 py-2 hover:bg-purple-50 cursor-pointer">Electronics</li>
                        <li class="px-4 py-2 hover:bg-purple-50 cursor-pointer">Men's Fashion</li>
                        <li class="px-4 py-2 hover:bg-purple-50 cursor-pointer">Women's Fashion</li>
                        <li class="px-4 py-2 hover:bg-purple-50 cursor-pointer">Home & Living</li>
                        <li class="px-4 py-2 hover:bg-purple-50 cursor-pointer">Mobiles & Tablets</li>
                    </ul>
                </div>
            </div>
            <input type="text" placeholder="Search in CartZen..." class="flex-1 px-4 py-2 outline-none text-sm">
            <button class="CartZen-gradient-bg text-white px-6 py-2 hover:opacity-90 transition">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Cart & Login -->
        <div class="flex items-center gap-6">
            <a href="#" class="text-gray-700 hover:text-purple-500 flex items-center gap-1 text-sm">
                <i class="fas fa-user-circle text-2xl"></i>
                <span class="hidden md:inline">Account</span>
            </a>
            <a href="#" class="text-gray-700 hover:text-purple-500 flex items-center gap-1 text-sm relative">
                <i class="fas fa-shopping-cart text-2xl"></i>
                <span class="absolute -top-2 -right-3 bg-purple-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                <span class="hidden md:inline">Cart</span>
            </a>
        </div>
    </div>

    <!-- Category Mega Menu Bar -->
    <div class="bg-white border-b border-purple-100 hidden lg:block">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center gap-8 h-14 text-sm font-medium">

            <button
                class="flex items-center gap-2 text-purple-700 font-semibold">
                <i class="fas fa-bars"></i>
                Categories
            </button>

            <a href="#" class="hover:text-purple-600 transition">
                Flash Sale
            </a>

            <a href="#" class="hover:text-purple-600 transition">
                Mall
            </a>

            <a href="#" class="hover:text-purple-600 transition">
                Vouchers
            </a>

            <a href="#" class="hover:text-purple-600 transition">
                Free Shipping
            </a>

            <a href="#" class="hover:text-purple-600 transition">
                Customer Care
            </a>

        </div>

    </div>
</div>
</nav>