<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-3xl font-extrabold text-primary-600"><img class="h-[90px]" src="frontend/images/cartzen_logo.png " alt=""></a>
        <div class="hidden md:flex space-x-6 items-center">
            <a href="{{ route('home') }}" class="hover:text-primary-600 transition">Home</a>
            <a href="{{ route('shop') }}" class="hover:text-primary-600 transition">Shop</a>
            <a href="{{ route('cart.index') }}" class="hover:text-primary-600 transition">Cart</a>
            @auth
                @if(auth()->user()->role == 'vendor')
                    <a href="{{ route('vendor.dashboard') }}" class="hover:text-primary-600">Dashboard</a>
                @endif
                @if(auth()->user()->role == 'admin')
                    <a href="/admin" class="hover:text-primary-600">Admin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-primary-600">Login</a>
                <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700">Register</a>
            @endauth
        </div>
    </div>
</nav>