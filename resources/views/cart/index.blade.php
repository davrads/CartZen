@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

@if($cartItems->count())
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($cartItems as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $item->product->image) }}" class="w-12 h-12 object-cover rounded">
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">{{ $item->product->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">Rs. {{ number_format($item->product->price) }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-20 border rounded px-2 py-1">
                                <button type="submit" class="text-blue-600 hover:underline text-sm">Update</button>
                            </form>
                        </td>
                        <td class="px-6 py-4">Rs. {{ number_format($item->product->price * $item->quantity) }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right font-bold">Total:</td>
                    <td class="px-6 py-4 font-bold text-orange-600">Rs. {{ number_format($subtotal) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('products.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded hover:bg-gray-300">Continue Shopping</a>
        <a href="{{ route('checkout.index') }}" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700">Proceed to Checkout</a>
    </div>
@else
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <p class="text-gray-500 mb-4">Your cart is empty.</p>
        <a href="{{ route('products.index') }}" class="bg-orange-600 text-white px-6 py-2 rounded">Shop Now</a>
    </div>
@endif
@endsection