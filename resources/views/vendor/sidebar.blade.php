<div class="w-64 bg-white shadow-md rounded p-4">
    <h3 class="font-bold text-lg">Vendor Panel</h3>
    <ul class="mt-4 space-y-2">
        <li><a href="{{ route('vendor.dashboard') }}" class="block text-gray-700 hover:text-orange-600">Dashboard</a></li>
        <li><a href="{{ route('vendor.products.index') }}" class="block text-gray-700 hover:text-orange-600">My Products</a></li>
        <li><a href="{{ route('vendor.orders.index') }}" class="block text-gray-700 hover:text-orange-600">Orders</a></li>
    </ul>
</div>