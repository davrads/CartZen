@extends('layouts.app')

@section('content')
<div class="flex">
    @include('vendor.sidebar')
    <div class="flex-1 ml-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Order #{{ $order->order_number }}</h1>
            <a href="{{ route('vendor.orders.index') }}" class="text-orange-600 hover:underline">← Back to Orders</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="font-semibold text-lg mb-2">Customer Details</h2>
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
                </div>
                <div>
                    <h2 class="font-semibold text-lg mb-2">Order Information</h2>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                    <p><strong>Order Status:</strong>
                        <span class="px-2 py-1 text-xs rounded
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                            @elseif($order->status == 'delivered') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Payment Status:</strong>
                        <span class="px-2 py-1 text-xs rounded
                            @if($order->payment_status == 'paid') bg-green-100 text-green-800
                            @elseif($order->payment_status == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                </div>
            </div>

            <h2 class="font-semibold text-lg mt-6 mb-3">Products in this Order (Your Items)</h2>
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium">Product</th>
                        <th class="px-4 py-2 text-left text-xs font-medium">Quantity</th>
                        <th class="px-4 py-2 text-left text-xs font-medium">Price</th>
                        <th class="px-4 py-2 text-left text-xs font-medium">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orderItems as $item)
                    <tr>
                        <td class="px-4 py-2">{{ $item->product->name }}</td>
                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                        <td class="px-4 py-2">Rs. {{ number_format($item->price) }}</td>
                        <td class="px-4 py-2">Rs. {{ number_format($item->price * $item->quantity) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection