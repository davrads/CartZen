@extends('layouts.app')

@section('title', $categoryName ?? 'Mobiles & Tablets - Cartzen')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $categoryName ?? 'Mobiles & Tablets' }}</h1>
            <p class="text-gray-600 mt-1">Showing 1-20 of 245 products</p>
        </div>
        <div class="flex items-center gap-4 mt-4 md:mt-0">
            <select class="border border-gray-300 rounded-2xl px-5 py-3 focus:outline-none focus:border-purple-500">
                <option>Sort by Popularity</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
                <option>Newest First</option>
            </select>
        </div>
    </div>

    <!-- Products Grid - 4 in One Row -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <x-product-card 
            image="https://img.drz.lazcdn.com/static/np/p/437109d640763f5dbd0d8612ed114224.jpg_400x400q75.avif"
            name="Samsung Galaxy A14 (4GB/128GB) - Official Store"
            price="18999"
            original_price="25999"
            discount="true" />

        <x-product-card 
            image="https://via.placeholder.com/300x300/10B981/ffffff?text=boAt+Headphones"
            name="boAt Rockers 450 Wireless Headphones"
            price="2399"
            original_price="3499"
            discount="true" />

        <x-product-card 
            image="https://via.placeholder.com/300x300/8B5CF6/ffffff?text=Redmi+Note"
            name="Xiaomi Redmi Note 13 5G (8GB/256GB)"
            price="23999"
            original_price="28999"
            discount="true" />

        <x-product-card 
            image="https://via.placeholder.com/300x300/F472B6/ffffff?text=Realme+C67"
            name="Realme C67 5G (8GB/128GB)"
            price="17999"
            original_price="21999"
            discount="true" />
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-12">
        <div class="flex items-center gap-2">
            <button class="px-5 py-3 border rounded-2xl hover:bg-gray-100">Previous</button>
            <button class="px-5 py-3 bg-primary text-white rounded-2xl">1</button>
            <button class="px-5 py-3 border rounded-2xl hover:bg-gray-100">2</button>
            <button class="px-5 py-3 border rounded-2xl hover:bg-gray-100">3</button>
            <button class="px-5 py-3 border rounded-2xl hover:bg-gray-100">Next</button>
        </div>
    </div>

</div>
@endsection