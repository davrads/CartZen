<nav class="bg-white shadow-sm sticky top-0 z-50">
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
            <div class="flex-1 max-w-2xl mx-4 hidden sm:block">
                <form action="{{ route('search') }}" method="GET" class="relative group w-full">
                    <div class="flex shadow-sm border border-gray-300 rounded-lg overflow-hidden bg-white focus-within:border-violet-500 focus-within:ring-1 focus-within:ring-violet-500 transition">
                        <input type="text" 
                               name="query" 
                               value="{{ request('query') }}" 
                               placeholder="Search in CartZen..." 
                               required
                               class="flex-1 px-4 py-2.5 outline-none text-sm text-gray-700 placeholder-gray-400">
                        <button type="submit" class="bg-violet-600 text-white px-6 py-2.5 hover:bg-violet-700 transition flex items-center justify-center">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex items-center gap-4 md:gap-6">
                <a href="/user_profile" class="text-gray-700 hover:text-purple-600 flex items-center gap-2 text-sm font-medium transition">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span class="hidden sm:inline">Account</span>
                </a>
               
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-purple-600 flex items-center gap-2 text-sm font-medium relative transition">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    @php
                        $cartCount = 0;
                        if (auth()->guard('customer')->check()) {
                            $cart = App\Models\Cart::where('user_id', auth()->guard('customer')->id())->first();
                            if ($cart) {
                                $cartCount = $cart->items->sum('quantity');
                            }
                        }
                    @endphp
                    <span class="absolute -top-1 -right-1 bg-violet-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
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

        <div class="hidden md:flex items-center justify-between py-2 border-t border-gray-100 text-sm">
            <div class="flex items-center gap-6">
                <a href="#" class="text-gray-700 hover:text-purple-600 transition">Mall</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition">Vouchers</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition">Free Shipping</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition">Customer Care</a>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden pb-4 pt-2 border-t border-gray-100">
            <a href="{{ route('home') }}" class="block text-gray-700 hover:text-purple-600 font-medium px-3 py-2 rounded hover:bg-purple-50">Home</a>
            <a href="{{ route('shop', ['slug' => 'mobiles-tablets']) }}" class="block text-gray-700 hover:text-purple-600 font-medium px-3 py-2 rounded hover:bg-purple-50">Shop</a>
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