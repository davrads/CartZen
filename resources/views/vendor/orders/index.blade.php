@extends('layouts.app')

@section('content')
<div class="flex">
    @include('vendor.sidebar')
    <div class="flex-1 ml-6">
        <h1 class="text-2xl font-bold mb-6">My Orders</h1>

        @if($orderItems->count())
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total (Item)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($orderItems as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $item->order->order_number }}</td>
                            <td class="px-6 py-4">{{ $item->order->user->name }}</td>
                            <td class="px-6 py-4">{{ $item->product->name }}</td>
                            <td class="px-6 py-4">{{ $item->quantity }}</td>
                            <td class="px-6 py-4">Rs. {{ number_format($item->price * $item->quantity) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded
                                    @if($item->order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($item->order->status == 'processing') bg-blue-100 text-blue-800
                                    @elseif($item->order->status == 'shipped') bg-purple-100 text-purple-800
                                    @elseif($item->order->status == 'delivered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($item->order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded
                                    @if($item->order->payment_status == 'paid') bg-green-100 text-green-800
                                    @elseif($item->order->payment_status == 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($item->order->payment_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('vendor.orders.show', $item->order_id) }}" class="text-orange-600 hover:underline">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $orderItems->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-500">No orders have been placed for your products yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection