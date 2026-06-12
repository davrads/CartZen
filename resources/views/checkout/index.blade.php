@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Checkout</h1>

<div class="flex flex-col lg:flex-row gap-8">
    {{-- Checkout Form --}}
    <div class="flex-1 bg-white rounded-lg shadow p-6">
        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
            @csrf

            <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
            <textarea name="shipping_address" rows="3" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-600" required placeholder="Enter your full address..."></textarea>

            <h2 class="text-xl font-semibold mt-6 mb-4">Payment Method</h2>
            <div class="space-y-2">
                <label class="flex items-center space-x-3">
                    <input type="radio" name="payment_method" value="razorpay" checked class="form-radio text-orange-600">
                    <span>Razorpay (Credit/Debit Card, UPI, NetBanking)</span>
                </label>
            </div>

            <button type="submit" class="mt-6 w-full bg-orange-600 text-white py-3 rounded-lg font-semibold hover:bg-orange-700">Place Order & Pay</button>
        </form>
    </div>

    {{-- Order Summary --}}
    <div class="lg:w-96 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
        @foreach($cartItems as $item)
            <div class="flex justify-between mb-2">
                <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                <span>Rs. {{ number_format($item->product->price * $item->quantity) }}</span>
            </div>
        @endforeach
        <hr class="my-3">
        <div class="flex justify-between font-bold text-lg">
            <span>Total</span>
            <span class="text-orange-600">Rs. {{ number_format($subtotal) }}</span>
        </div>
    </div>
</div>
@endsection