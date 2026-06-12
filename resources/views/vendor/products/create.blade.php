@extends('layouts.app')

@section('content')
<div class="flex">
    @include('vendor.sidebar')
    <div class="flex-1 ml-6">
        <h1 class="text-2xl font-bold mb-6">Add New Product</h1>
        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Product Name</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Category</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Price (Rs.)</label>
                    <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Compare Price (MRP)</label>
                    <input type="number" name="compare_price" step="0.01" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Stock</label>
                    <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Product Image</label>
                    <input type="file" name="image" class="w-full border rounded px-3 py-2">
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Description</label>
                    <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
                </div>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="is_flash_deal" value="1">
                        <span>Mark as Flash Deal</span>
                    </label>
                    <label>Flash deal end date</label>
                    <input type="datetime-local" name="flash_deal_ends_at" class="border rounded px-2 py-1">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded">Save Product</button>
                <a href="{{ route('vendor.products.index') }}" class="ml-4 text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection