@extends('layouts.app')

@section('content')
<div class="flex">
    @include('vendor.sidebar')   {{-- partial sidebar for vendor menu --}}
    <div class="flex-1 ml-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">My Products</h1>
            <a href="{{ route('vendor.products.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded">+ Add Product</a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4"><img src="{{ asset('storage/'.$product->image) }}" class="w-12 h-12 object-cover rounded"></td>
                            <td class="px-6 py-4">{{ $product->name }}</td>
                            <td class="px-6 py-4">Rs. {{ number_format($product->price) }}</td>
                            <td class="px-6 py-4">{{ $product->stock }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('vendor.products.edit', $product) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
</div>
@endsection