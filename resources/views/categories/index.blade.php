@extends('layouts.app')

@section('content')

@if(isset($category))
<div class="category-main-block-section  px-6 py-3 text-sm">
    <a href="{{ url('/') }}" class="text-gray-500 hover:text-violet-600">Home</a>
    <span class="mx-2">></span>
    <a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-violet-600">Categories</a>
    <span class="mx-2">></span>
    <span class="font-medium text-violet-600">
        {{ $category->name }}
    </span>
</div>
@endif


<style>
    .category-main-block-section {
        width: 1240px;
        margin: 0 auto;
    }
</style>

<body class="bg-gray-50 min-h-screen py-4 sm:py-8 px-4">

    <section class="flex category-main-block category-main-block-section">

        <div class="w-64 flex-shrink-0">

            <div class="bg-white border-r border-gray-200 p-4">
                <h2 class="text-lg font-bold text-gray-900 mb-4">All Categories</h2>
                <div class="space-y-1">


                    <div class="pl-4">
                        @foreach($categories as $cats)
                        <a href="{{ route('categories.show', $cats) }}" class="w-full text-left px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-violet-600 rounded-md transition-colors block">
                            <span>{{ $cats->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white border-r border-gray-200 p-4 mt-4">
                <h2 class="text-xl font-bold mb-4">Brand</h2>
                <div class="space-y-3 mb-6">
                    <label class="flex items-center gap-3 cursor-pointer font-bold"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Samsung</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Apple</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Xiaomi</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> OnePlus</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Realme</label>
                    <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Vivo</label>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <div class="bg-white border-b px-6 py-5 flex justify-between items-center">
                <div>

                    <h1 class="text-2xl font-bold">{{ $category->name }}</h1>
                    <p class="text-sm text-gray-600">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} products</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600">Sort by:</span>
                    <select class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none">
                        <option>Popular</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                    <x-product-card :product=$product />
                    @empty
                    <p>No products found.</p>
                    @endforelse
                </div>
                <div class="mt-8 flex justify-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>

    </section>
</body>
@endsection