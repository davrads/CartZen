@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <aside class="md:w-1/4 bg-white p-4 rounded-xl shadow h-fit">
            <h3 class="font-bold text-xl mb-4">Categories</h3>
            <ul class="space-y-2">
                @foreach($categories as $cat)
                    <li><a href="#" class="hover:text-primary-600">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
        </aside>
        <div class="md:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
            <div class="mt-8">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection