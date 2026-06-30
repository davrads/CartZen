@extends('layouts.app')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="bg-gray-50 min-h-screen py-4 sm:py-8 px-4">
  <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    
    <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between gap-4">
      <div class="flex items-center gap-1.5 shrink-0">
        <h1 class="text-xl font-bold text-gray-900">My Cart Item ({{ count($cart) }})</h1>
      </div>
      
      <div class="relative flex-1 max-w-xs">
        <input type="text" placeholder="Search for products..." class="w-full text-xs border border-gray-200 rounded-lg py-2 pl-3 pr-9 focus:outline-none focus:border-violet-400 bg-gray-50 text-gray-600"/>
      </div>
    </header>

    @if(count($cart) > 0)
    <div class="px-6 py-3 bg-gray-50/60 border-b border-gray-100 flex items-center justify-between">
      <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-gray-700">
        <input type="checkbox" id="select-all-cart" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600 cursor-pointer">
        <label for="select-all-cart" class="cursor-pointer select-none">Select All Items</label>
      </div>
    </div>
    @endif

    <div class="divide-y divide-gray-100 px-6">
      @forelse($cart as $id => $item)
      <div class="py-5 space-y-4">
        <div class="flex items-center justify-between flex-wrap gap-2 text-xs">
          <div class="flex items-center gap-2">
            <input type="checkbox" checked class="item-checkbox w-4 h-4 rounded text-violet-600 accent-violet-600 cursor-pointer">
            <span class="font-bold text-gray-800 text-sm">{{ $item['brand'] ?? 'Official Store' }}</span>
          </div>
        </div>
        
        <div class="flex items-start gap-4">
          <div class="w-20 h-20 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center p-2 shrink-0">
            <img src="{{ asset('storage/' . $item['thumbnail']) }}" alt="{{ $item['name'] }}" class="object-cover h-full w-full rounded-lg">
          </div>
          
          <div class="flex-1 min-w-0 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div>
              <h3 class="font-bold text-gray-800 text-sm sm:text-base leading-tight truncate">{{ $item['name'] }}</h3>
              <div class="flex items-baseline gap-2 mt-2">
                <span class="font-bold text-gray-900 text-sm sm:text-base">
                  Rs. {{ number_format($item['discounted_price'] ?? $item['price'], 2) }}
                </span>
                @if($item['discounted_price'])
                <span class="text-xs text-gray-400 line-through">Rs. {{ number_format($item['price'], 2) }}</span>
                @endif
              </div>
            </div>
            
            <div class="flex items-center gap-3 self-end sm:self-center">
              <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                <button type="button" onclick="updateCartQuantity('{{ $id }}', -1)" class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition">-</button>
                <span id="qty-{{ $id }}" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-white">{{ $item['quantity'] }}</span>
                <button type="button" onclick="updateCartQuantity('{{ $id }}', 1)" class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition">+</button>
              </div>
              
              <a href="{{ route('cart.remove', $id) }}" class="text-gray-300 hover:text-red-500 transition p-1">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="py-12 text-center text-gray-500">
          Your cart is empty!
      </div>
      @endforelse
    </div>

    <div class="bg-gray-50 p-6 border-t border-gray-100 space-y-4">
      <h4 class="font-bold text-gray-900 text-sm uppercase tracking-wider">Price Details</h4>
      
      <div class="space-y-2.5 text-sm">
        <div class="flex justify-between text-gray-500">
          <span>Subtotal ({{ count($cart) }} items)</span>
          <span class="font-medium text-gray-800">Rs. {{ number_format($subtotal, 2) }}</span>
        </div>
        <div class="flex justify-between text-gray-500">
          <span>Discount</span>
          <span class="font-medium text-emerald-600">- Rs. {{ number_format($discount, 2) }}</span>
        </div>
        <div class="flex justify-between text-gray-500">
          <span>Delivery Fee</span>
          <span class="font-bold text-emerald-600 text-xs tracking-wide uppercase">Free</span>
        </div>
      </div>

      <hr class="border-gray-200/80 my-3">

      <div class="flex justify-between items-center pb-2">
        <span class="font-bold text-gray-900 text-base">Total Amount</span>
        <span class="font-bold text-violet-700 text-lg sm:text-xl">Rs. {{ number_format($total, 2) }}</span>
      </div>

      {{-- Changed from <button> to <a> with proper route --}}
      <a href="{{ route('checkout') }}" class="w-full bg-violet-600 hover:bg-violet-700 active:bg-violet-800 text-white font-semibold text-center py-3.5 rounded-2xl shadow-md hover:shadow-lg transition duration-200 block">
        Proceed to Checkout
      </a>
    </div>

  </div>
</div>

<script>
// Select All र Individual Checkboxes को अन्तरक्रिया मिलाउने Script
document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all-cart');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');

    if (selectAllCheckbox) {
        // १. मुख्य Checkbox क्लिक गर्दा सबैलाई सामूहिक रूपमा Tick/Untick गर्ने
        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // २. कुनै एउटा मात्र बक्स अनटिक गरेमा 'Select All' लाई पनि आफैँ अनटिक गराउने
        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const allChecked = Array.from(itemCheckboxes).every(item => item.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });
    }
});

function updateCartQuantity(cartId, change) {
    let qtyElement = document.getElementById('qty-' + cartId);
    if (!qtyElement) return;

    let currentQty = parseInt(qtyElement.innerText);
    let newQty = currentQty + change;

    if (newQty < 1) return;

    // सुरक्षाको लागि Meta Tag बाट CSRF टोकन तान्ने
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch("{{ route('cart.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({
            id: cartId,
            quantity: newQty
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // ब्याकइन्डमा मात्रा सेभ भएपछि नयाँ हिसाब देखाउन पेज रिफ्रेस गर्ने
            window.location.reload();
        } else {
            alert(data.message || 'Error updating cart!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Could not update quantity. Please try again.');
    });
}
</script>

@endsection


{{-- @extends('layouts.app')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="bg-gray-50 min-h-screen py-4 sm:py-8 px-4">
  <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    
    <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between gap-4">
      <div class="flex items-center gap-1.5 shrink-0">
        <h1 class="text-xl font-bold text-gray-900">My Cart Item ({{ count($cart) }})</h1>
      </div>
      
      <div class="relative flex-1 max-w-xs">
        <input type="text" placeholder="Search for products..." class="w-full text-xs border border-gray-200 rounded-lg py-2 pl-3 pr-9 focus:outline-none focus:border-violet-400 bg-gray-50 text-gray-600"/>
      </div>
    </header>

    @if(count($cart) > 0)
    <div class="px-6 py-3 bg-gray-50/60 border-b border-gray-100 flex items-center justify-between">
      <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-gray-700">
        <input type="checkbox" id="select-all-cart" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600 cursor-pointer">
        <label for="select-all-cart" class="cursor-pointer select-none">Select All Items</label>
      </div>
    </div>
    @endif

    <div class="divide-y divide-gray-100 px-6">
      @forelse($cart as $id => $item)
      <div class="py-5 space-y-4">
        <div class="flex items-center justify-between flex-wrap gap-2 text-xs">
          <div class="flex items-center gap-2">
            <input type="checkbox" checked class="item-checkbox w-4 h-4 rounded text-violet-600 accent-violet-600 cursor-pointer">
            <span class="font-bold text-gray-800 text-sm">{{ $item['brand'] ?? 'Official Store' }}</span>
          </div>
        </div>
        
        <div class="flex items-start gap-4">
          <div class="w-20 h-20 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center p-2 shrink-0">
            <img src="{{ asset('storage/' . $item['thumbnail']) }}" alt="{{ $item['name'] }}" class="object-cover h-full w-full rounded-lg">
          </div>
          
          <div class="flex-1 min-w-0 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div>
              <h3 class="font-bold text-gray-800 text-sm sm:text-base leading-tight truncate">{{ $item['name'] }}</h3>
              <div class="flex items-baseline gap-2 mt-2">
                <span class="font-bold text-gray-900 text-sm sm:text-base">
                  Rs. {{ number_format($item['discounted_price'] ?? $item['price'], 2) }}
                </span>
                @if($item['discounted_price'])
                <span class="text-xs text-gray-400 line-through">Rs. {{ number_format($item['price'], 2) }}</span>
                @endif
              </div>
            </div>
            
            <div class="flex items-center gap-3 self-end sm:self-center">
              <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                <button type="button" onclick="updateCartQuantity('{{ $id }}', -1)" class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition">-</button>
                <span id="qty-{{ $id }}" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-white">{{ $item['quantity'] }}</span>
                <button type="button" onclick="updateCartQuantity('{{ $id }}', 1)" class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition">+</button>
              </div>
              
              <a href="{{ route('cart.remove', $id) }}" class="text-gray-300 hover:text-red-500 transition p-1">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="py-12 text-center text-gray-500">
          Your cart is empty!
      </div>
      @endforelse
    </div>

    <div class="bg-gray-50 p-6 border-t border-gray-100 space-y-4">
      <h4 class="font-bold text-gray-900 text-sm uppercase tracking-wider">Price Details</h4>
      
      <div class="space-y-2.5 text-sm">
        <div class="flex justify-between text-gray-500">
          <span>Subtotal ({{ count($cart) }} items)</span>
          <span class="font-medium text-gray-800">Rs. {{ number_format($subtotal, 2) }}</span>
        </div>
        <div class="flex justify-between text-gray-500">
          <span>Discount</span>
          <span class="font-medium text-emerald-600">- Rs. {{ number_format($discount, 2) }}</span>
        </div>
        <div class="flex justify-between text-gray-500">
          <span>Delivery Fee</span>
          <span class="font-bold text-emerald-600 text-xs tracking-wide uppercase">Free</span>
        </div>
      </div>

      <hr class="border-gray-200/80 my-3">

      <div class="flex justify-between items-center pb-2">
        <span class="font-bold text-gray-900 text-base">Total Amount</span>
        <span class="font-bold text-violet-700 text-lg sm:text-xl">Rs. {{ number_format($total, 2) }}</span>
      </div>

      <button class="w-full bg-violet-600 hover:bg-violet-700 active:bg-violet-800 text-white font-semibold text-center py-3.5 rounded-2xl shadow-md hover:shadow-lg transition duration-200">
        Proceed to Checkout
      </button>
    </div>

  </div>
</div>

<script>
// Select All र Individual Checkboxes को अन्तरक्रिया मिलाउने Script
document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all-cart');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');

    if (selectAllCheckbox) {
        // १. मुख्य Checkbox क्लिक गर्दा सबैलाई सामूहिक रूपमा Tick/Untick गर्ने
        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // २. कुनै एउटा मात्र बक्स अनटिक गरेमा 'Select All' लाई पनि आफैँ अनटिक गराउने
        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const allChecked = Array.from(itemCheckboxes).every(item => item.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });
    }
});

function updateCartQuantity(cartId, change) {
    let qtyElement = document.getElementById('qty-' + cartId);
    if (!qtyElement) return;

    let currentQty = parseInt(qtyElement.innerText);
    let newQty = currentQty + change;

    if (newQty < 1) return;

    // सुरक्षाको लागि Meta Tag बाट CSRF टोकन तान्ने
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch("{{ route('cart.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({
            id: cartId,
            quantity: newQty
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // ब्याकइन्डमा मात्रा सेभ भएपछि नयाँ हिसाब देखाउन पेज रिफ्रेस गर्ने
            window.location.reload();
        } else {
            alert(data.message || 'Error updating cart!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Could not update quantity. Please try again.');
    });
}
</script>

@endsection --}}