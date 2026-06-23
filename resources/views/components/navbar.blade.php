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
            <div class="flex-1 max-w-2xl mx-4 hidden sm:block">
                <div class="relative group w-full">
                    <div class="flex shadow-sm border border-gray-300 rounded-lg overflow-hidden bg-white">
                        <input type="text" placeholder="Search in CartZen..." class="flex-1 px-4 py-2.5 outline-none text-sm text-gray-700 placeholder-gray-400">
                        <button class="bg-primary text-white px-6 py-2.5 hover:opacity-90 transition flex items-center justify-center">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4 md:gap-6">
                <a href="/user_profile" class="text-gray-700 hover:text-purple-600 flex items-center gap-2 text-sm font-medium transition">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span class="hidden sm:inline">Account</span>
                </a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-purple-600 flex items-center gap-2 text-sm font-medium relative transition">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="absolute -top-2 -right-3 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center border-2 border-white">0</span>
                    <span class="hidden sm:inline">Cart</span>
                </a>
            </div>
        </div>
        <div class="sm:hidden pb-3">
            <div class="relative group w-full">
                <div class="flex shadow-sm border border-gray-300 rounded-lg overflow-hidden bg-white">
                    <input type="text" placeholder="Search in CartZen..." class="flex-1 px-4 py-2.5 outline-none text-sm">
                    <button class="bg-primary text-white px-4 py-2.5 hover:opacity-90 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-100 py-3 flex flex-col sm:flex-row items-start sm:items-center gap-y-2 sm:gap-6">
            
            <div class="flex flex-wrap items-center gap-5 text-sm font-medium w-full sm:w-auto justify-start sm:justify-start">
                <a href="#" class="text-red-600 hover:text-red-700 flex items-center gap-1.5 transition">
                    <i class="fas fa-bolt"></i> Flash Sale
                </a>
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
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
    });
</script>