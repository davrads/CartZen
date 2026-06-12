@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow p-8 text-center">
    <div class="text-green-600 text-6xl mb-4">✓</div>
    <h1 class="text-2xl font-bold mb-2">Payment Successful!</h1>
    <p class="text-gray-600 mb-4">Thank you for your order. Your order number is <strong>{{ $order->order_number }}</strong>.</p>
    <p class="text-gray-600 mb-6">You will receive a confirmation email shortly.</p>
    <a href="{{ route('home') }}" class="bg-orange-600 text-white px-6 py-2 rounded">Continue Shopping</a>
</div>
@endsection