@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-64 bg-white shadow-md rounded p-4">
        <h3 class="font-bold">Vendor Menu</h3>
        <ul class="mt-4 space-y-2">
            <li><a href="{{ route('vendor.dashboard') }}" class="text-orange-600">Dashboard</a></li>
            <li><a href="{{ route('vendor.products.index') }}">My Products</a></li>
        </ul>
    </div>
    <div class="flex-1 ml-6">
        <h1 class="text-2xl font-bold">Vendor Dashboard</h1>
        <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="bg-white p-4 rounded shadow">Products: {{ $productsCount }}</div>
            <div class="bg-white p-4 rounded shadow">Sales: Rs. {{ number_format($totalSales) }}</div>
            <div class="bg-white p-4 rounded shadow">Pending Orders: {{ $pendingOrders }}</div>
        </div>
    </div>
</div>
@endsection