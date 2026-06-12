@extends('layouts.app')

@section('content')
<div class="flex">
    @include('vendor.sidebar')
    <div class="flex-1 ml-6">
        <h1 class="text-2xl font-bold mb-6">Edit Product: {{ $product->name }}</h1>
        <form action="{{ route('vendor.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label>Category</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Price (Rs.)</label>
                    <input type="number" name="price" value="{{ $product->price }}" step="0.01" required>
                </div>
                <div>
                    <label>Compare Price</label>
                    <input type="number" name="compare_price" value="{{ $product->compare_price }}" step="0.01">
                </div>
                <div>
                    <label>Stock</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" required>
                </div>
                <div>
                    <label>Image (new)</label>
                    <input type="file" name="image">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-20 mt-2">
                    @endif
                </div>
                <div class="md:col-span-2">
                    <label>Description</label>
                    <textarea name="description" rows="4" required>{{ $product->description }}</textarea>
                </div>
                <div class="flex items-center space-x-4">
                    <label>
                        <input type="checkbox" name="is_flash_deal" value="1" {{ $product->is_flash_deal ? 'checked' : '' }}> Flash Deal
                    </label>
                    <input type="datetime-local" name="flash_deal_ends_at" value="{{ $product->flash_deal_ends_at ? $product->flash_deal_ends_at->format('Y-m-d\TH:i') : '' }}">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded">Update Product</button>
                <a href="{{ route('vendor.products.index') }}" class="ml-4 text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection