<nav class="bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 py-3">
            <div class="flex items-center gap-4">
                <button id="mobile-menu-btn" class="md:hidden text-gray-700 hover:text-purple-600 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <a href="{{ route('home') }}">
                    <img class="h-12 md:h-14 w-auto" src="{{ asset('images/cartzen_logo.PNG') }}" alt="CartZen Logo">
                </a>
            </div>

            {{-- Desktop Search Form --}}
            <div class="flex-1 max-w-3xl mx-6 hidden sm:block">
                <form action="{{ route('search') }}" method="GET" class="relative group w-full">
                    <div class="flex overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm hover:shadow-md focus-within:border-violet-500 focus-within:ring-2 focus-within:ring-violet-200 transition-all duration-300"> <input type="text"
                            name="query"
                            value="{{ request('query') }}"
                            placeholder="Search any products in CartZen..."
                            required
                            class="flex-1 px-5 py-3 outline-none text-sm text-gray-700 placeholder:text-gray-400">
                        <button type="submit" class="bg-violet-600 text-white px-7 py-3 hover:bg-violet-700 transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex items-center gap-5 px-3 py-2 rounded-xl hover:bg-violet-50 transition md:gap-7">
                <a href="/user_profile"
                    class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-gray-700 hover:bg-violet-50 hover:text-violet-600 transition-all duration-200">
                    <i class="fas fa-user-circle text-2xl text-violet-600"></i>
                    <span class="hidden sm:inline">Account</span>
                </a>

                <a href="{{ route('cart.index') }}"
                    class="relative flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-gray-700 hover:bg-violet-50 hover:text-violet-600 transition-all duration-200">
                    <i class="fas fa-shopping-cart text-2xl text-violet-600"></i>
                    @php
                    $cartCount = 0;
                    if (auth()->guard('customer')->check()) {
                    $cart = App\Models\Cart::where('user_id', auth()->guard('customer')->id())->first();
                    if ($cart) {
                    $cartCount = $cart->items->sum('quantity');
                    }
                    }
                    @endphp
                    <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-gray-300 text-[10px] font-bold text-white ring-2 ring-white">
                        {{ $cartCount }}
                    </span>
                    <span class="hidden sm:inline">Cart</span>
                </a>
            </div>
        </div>

        {{-- Mobile Search Form (Mobile मा देखिने गरी) --}}
        <div class="block sm:hidden pb-3">
            <form action="{{ route('search') }}" method="GET" class="relative w-full">
                <div class="flex border border-gray-300 rounded-lg overflow-hidden bg-white">
                    <input type="text"
                        name="query"
                        value="{{ request('query') }}"
                        placeholder="Search in CartZen..."
                        required
                        class="flex-1 px-3 py-2 outline-none text-sm text-gray-700 placeholder-gray-400">
                    <button type="submit" class="bg-violet-600 text-white px-4 py-2 hover:bg-violet-700 transition flex items-center justify-center">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="hidden md:flex items-center gap-8 py-3 border-t border-gray-100 text-sm">

            <a href="{{ route('shop-on-sale') }}"
                class="font-medium text-gray-600 hover:text-violet-600 transition-colors duration-200">
                Flash Sale
            </a>

            <a href="{{ route('products.index') }}"
                class="font-medium text-gray-600 hover:text-violet-600 transition-colors duration-200">
                Products
            </a>

            <a href="{{ route('categories.index') }}"
                class="font-medium text-gray-600 hover:text-violet-600 transition-colors duration-200">
                Categories
            </a>

            <a href="{{ route('stores.index') }}"
                class="font-medium text-gray-600 hover:text-violet-600 transition-colors duration-200">
                Stores
            </a>

        </div>

        <div id="mobile-menu" class="hidden md:hidden pb-4 pt-2 border-t border-gray-100">
            <a href="{{ route('home') }}" class="block text-gray-700 hover:text-purple-600 font-medium px-3 py-2 rounded hover:bg-purple-50">Home</a>
            <a href="{{ route('shop-on-sale', ['slug' => 'mobiles-tablets']) }}" class="block text-gray-700 hover:text-purple-600 font-medium px-3 py-2 rounded hover:bg-purple-50">Shop</a>
            <a href="/categories" class="block text-gray-700 hover:text-purple-600 font-medium px-3 py-2 rounded hover:bg-purple-50">Categories</a>
            <a href="{{ route('cart.index') }}" class="block text-gray-700 hover:text-purple-600 font-medium px-3 py-2 rounded hover:bg-purple-50">Cart</a>
        </div>
    </div>
</nav>

<script>
    // मोबाइल मेनु खोल्ने र बन्द गर्ने सामान्य स्क्रिप्ट
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
</script>