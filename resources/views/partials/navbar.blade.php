<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="/" class="text-3xl font-bold primary-purple">Cartzen</a>
                
                <div class="relative w-[520px]">
                    <input type="text" 
                           placeholder="Search for products, brands and more" 
                           class="w-full pl-12 py-3.5 border border-gray-300 rounded-xl focus:outline-none focus:border-purple-500 text-base">
                    <i class="fas fa-search absolute left-5 top-4 text-gray-400 text-xl"></i>
                </div>
            </div>

            <div class="flex items-center gap-7 text-2xl">
                <a href="#" class="hover:text-purple-600"><i class="fas fa-user"></i></a>
                <a href="#" class="hover:text-purple-600"><i class="fas fa-heart"></i></a>
                <a href="{{ route('cart') }}" class="relative hover:text-purple-600">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">3</span>
                </a>
            </div>
        </div>
    </div>
</nav>