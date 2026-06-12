@extends('layouts.app')

@section('content')
    <!-- Hero Banner -->
    
        <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white rounded-xl p-8 mb-10">
        <h1 class="text-4xl font-bold">Big Deals, Better Life</h1>
        <p class="text-xl mt-2">Up to 60% Off on Top Products</p>
        <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-white text-orange-600 px-6 py-2 rounded-full font-semibold">Shop Now</a>
    </div>

    <!-- Features Row -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-4 rounded-lg shadow text-center"><span class="block text-2xl">🚚</span> Free Delivery <span class="text-sm text-gray-500">on orders over Rs.999</span></div>
        <div class="bg-white p-4 rounded-lg shadow text-center"><span class="block text-2xl">🔄</span> Easy Returns <span class="text-sm text-gray-500">within 7 days</span></div>
        <div class="bg-white p-4 rounded-lg shadow text-center"><span class="block text-2xl">✅</span> 100% Genuine <span class="text-sm text-gray-500">Original Products</span></div>
        <div class="bg-white p-4 rounded-lg shadow text-center"><span class="block text-2xl">🔒</span> Secure Payments <span class="text-sm text-gray-500">Safe & Protected</span></div>
    </div>

    <!-- Flash Deals -->
    <section class="mb-12">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">⚡ Flash Deals</h2>
            <span id="flashTimer" class="bg-red-100 text-red-800 px-4 py-1 rounded-full text-sm"></span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($flashDeals as $product)
                <div0 class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                        <div class="flex items-center space-x-2 mt-2">
                            <span class="text-orange-600 font-bold text-xl">Rs. {{ number_format($product->price) }}</span>
                            @if($product->compare_price)
                                <span class="text-gray-400 line-through">Rs. {{ number_format($product->compare_price) }}</span>
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">{{ $product->discount }}% off</span>
                            @endif
                        </div>
                        <a href="{{ route('product.show', $product->slug) }}" class="mt-3 block text-center bg-orange-600 text-white py-2 rounded">View Deal</a>
                    </div>
                </div0>
            @empty
                <p>No flash deals active.</p>
            @endforelse
        </div>
    </section>

    <!-- Featured Products -->
    <section>
        <h2 class="text-2xl font-bold mb-4">🔥 Featured Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow p-4">
                    <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-40 object-cover rounded">
                    <h3 class="font-semibold mt-2">{{ $product->name }}</h3>
                    <p class="text-orange-600 font-bold">Rs. {{ number_format($product->price) }}</p>
                    <a href="{{ route('product.show', $product->slug) }}" class="mt-2 inline-block text-sm text-orange-600">View →</a>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Simple countdown example – you can extend for real timer
    const flashEnds = @json($flashDeals->first()?->flash_deal_ends_at);
    if(flashEnds) {
        const timer = setInterval(() => {
            const now = new Date().getTime();
            const end = new Date(flashEnds).getTime();
            const diff = end - now;
            if(diff < 0) { clearInterval(timer); document.getElementById('flashTimer').innerText = 'Deals ended'; return; }
            const hours = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
            const mins = Math.floor((diff % (1000*60*60)) / (1000*60));
            const secs = Math.floor((diff % (1000*60)) / 1000);
            document.getElementById('flashTimer').innerText = `${hours}h ${mins}m ${secs}s`;
        }, 1000);
    }
</script>
@endpush