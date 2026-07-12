@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">My Order History</h1>
            <p class="text-sm text-gray-500 mt-1">तपाईंले अहिलेसम्म गर्नुभएका अर्डरहरूको विवरण।</p>
        </div>

        <div class="space-y-6">

            @forelse($orders as $order)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                    <div
                        class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-wrap justify-between items-center gap-4">
                        <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Order Date</p>
                                <p class="font-medium text-gray-800 mt-0.5">{{ $order->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Total Amount</p>
                                <p class="font-bold text-gray-900 mt-0.5">Rs. {{ number_format($order->total_amount) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Order ID</p>
                                <p class="font-mono text-gray-800 mt-0.5">#{{ $order->id }}</p>
                            </div>

                             <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Order Number</p>
                                <p class="font-mono text-gray-800 mt-0.5">#{{ $order->order_number }}</p>
                            </div>
                        </div>

                        <div>
                            @if ($order->status === 'completed' || $order->status === 'delivered')
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Delivered
                                </span>
                            @elseif($order->status === 'pending')
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                    Pending
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    {{ ucfirst($order->status) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="divide-y divide-gray-100">

                        @foreach ($order->items ?? [] as $item)
                        
                        <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-20 h-20 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden border border-gray-200">
                                    <img src="{{ $item->product->image_url ?? '/images/default-product.jpg' }}"
                                        alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900 hover:text-indigo-600 transition">
                                        {{ $item->product->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-0.5">Qty: {{ $item->quantity }}</p>
                                    <p class="text-sm font-semibold text-gray-800 mt-1">Rs.
                                        {{ number_format($item->price) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                <a href="{{ route('orders.show', $order->id) }}"
                                    class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition w-full sm:w-auto text-center">
                                    विवरण हेर्नुहोस्
                                </a>
                                <a href="{{ route('cart.add', $item->product_id) }}"
                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-sm font-medium rounded-lg text-white transition w-full sm:w-auto text-center">
                                    Buy Again
                                </a>
                            </div>
                        </div>
            @endforeach

        </div>

        <div
            class="px-6 py-3 bg-gray-50/50 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
            <p>Payment Method: <span class="font-medium text-gray-700">{{ $order->payment_method ?? 'Khalti' }}</span></p>
            <p>Delivery:
                <span class="{{ $order->shipping_cost == 0 ? 'text-green-600' : 'text-gray-700' }} font-medium">
                    {{ $order->shipping_cost == 0 ? 'Free Shipping' : 'Rs. ' . number_format($order->shipping_cost) }}
                </span>
            </p>
        </div>

    </div>
    @empty
        <div class="text-center py-12 bg-white border border-gray-200 rounded-xl">
            <p class="text-gray-500 text-lg">तपाईंले हालसम्म कुनै पनि अर्डर गर्नुभएको छैन।</p>
            <a href="/"
                class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                सामानहरू हेर्नुहोस्
            </a>
        </div>
        @endforelse

        </div>
        </div>
    @endsection
