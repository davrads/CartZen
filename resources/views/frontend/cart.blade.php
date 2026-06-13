@extends('layouts.app')
@section('content')

</head>
<body class="bg-gray-50 min-h-screen py-4 sm:py-8 px-4">

  <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    
    <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between gap-4">
      <div class="flex items-center gap-1.5 shrink-0">
       <h1 class="text-xl font-bold text-gray-900">My Cart (3)</h1>
      </div>
      
 

      <div class="relative flex-1 max-w-xs">
        <input type="text" placeholder="Search for products, brands and more" class="w-full text-xs border border-gray-200 rounded-lg py-2 pl-3 pr-9 focus:outline-none focus:border-violet-400 bg-gray-50 text-gray-600"/>
        <button class="absolute right-1 top-1/2 -translate-y-1/2 bg-violet-600 hover:bg-violet-700 transition rounded-md p-1.5">
          <svg width="12" height="12" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </button>
      </div>
    </header>

  

    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100 text-sm font-medium text-gray-600">
      <label class="flex items-center gap-2.5 cursor-pointer">
        <input type="checkbox" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600 cursor-pointer">
        <span>Select all</span>
      </label>
      <button class="flex items-center gap-1 text-gray-400 hover:text-red-500 transition text-xs">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
        Remove
      </button>
    </div>

    <div class="divide-y divide-gray-100 px-6">
      
      <div class="py-5 space-y-4">
        <div class="flex items-center justify-between flex-wrap gap-2 text-xs">
          <div class="flex items-center gap-2">
            <input type="checkbox" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600">
            <span class="font-bold text-gray-800 text-sm">Samsung Official Store</span>
            <button class="text-violet-600 font-semibold hover:underline">View Store</button>
          </div>
          <span class="text-gray-400">Delivery by: <span class="font-medium text-gray-600">May 27 - May 28</span></span>
        </div>
        <div class="flex items-start gap-4">
          <input type="checkbox" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600 mt-8">
          <div class="w-20 h-20 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center p-2 shrink-0">
            <img src="https://img.drz.lazcdn.com/g/kf/Sc0dffcc1ad8e435ba7ca50867faa211eR.jpg_400x400q80.jpg_.avif" alt="product image">
          </div>
          <div class="flex-1 min-w-0 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div>
              <h3 class="font-bold text-gray-800 text-sm sm:text-base leading-tight truncate">Massage Gun Deep Tissue Massager </h3>
              <p class="text-xs text-gray-400 mt-0.5">Black</p>
              <div class="flex items-baseline gap-2 mt-2">
                <span class="font-bold text-gray-900 text-sm sm:text-base">Rs. 18,999</span>
                <span class="text-xs text-gray-400 line-through">Rs. 20,999</span>
              </div>
            </div>
            <div class="flex items-center gap-3 self-end sm:self-center">
              <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                <button class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition font-medium">-</button>
                <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-white">1</span>
                <button class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition font-medium">+</button>
              </div>
              <button class="text-gray-300 hover:text-red-500 transition p-1">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="py-5 space-y-4">
        <div class="flex items-center justify-between flex-wrap gap-2 text-xs">
          <div class="flex items-center gap-2">
            <input type="checkbox" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600">
            <span class="font-bold text-gray-800 text-sm">boAt Official Store</span>
            <button class="text-violet-600 font-semibold hover:underline">View Store</button>
          </div>
          <span class="text-gray-400">Delivery by: <span class="font-medium text-gray-600">May 25 - May 27</span></span>
        </div>
        <div class="flex items-start gap-4">
          <input type="checkbox" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600 mt-8">
          <div class="w-20 h-20 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center p-2 shrink-0">
            <img src="https://img.drz.lazcdn.com/static/np/p/4f13aa638a6f732e5e3feb0a2fb1667b.jpg_400x400q75.avif" alt="product image">
          </div>
          <div class="flex-1 min-w-0 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div>
              <h3 class="font-bold text-gray-800 text-sm sm:text-base leading-tight truncate">boAt Rockerz 450</h3>
              <p class="text-xs text-gray-400 mt-0.5">Wireless Headphone</p>
              <div class="flex items-baseline gap-2 mt-2">
                <span class="font-bold text-gray-900 text-sm sm:text-base">Rs. 2,399</span>
                <span class="text-xs text-gray-400 line-through">Rs. 3,499</span>
              </div>
            </div>
            <div class="flex items-center gap-3 self-end sm:self-center">
              <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                <button class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition font-medium">-</button>
                <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-white">1</span>
                <button class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition font-medium">+</button>
              </div>
              <button class="text-gray-300 hover:text-red-500 transition p-1">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="py-5 space-y-4">
        <div class="flex items-center justify-between flex-wrap gap-2 text-xs">
          <div class="flex items-center gap-2">
            <input type="checkbox" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600">
            <span class="font-bold text-gray-800 text-sm">Patanjali Official Store</span>
            <button class="text-violet-600 font-semibold hover:underline">View Store</button>
          </div>
          <span class="text-gray-400">Delivery by: <span class="font-medium text-gray-600">May 25 - May 28</span></span>
        </div>
        <div class="flex items-start gap-4">
          <input type="checkbox" checked class="w-4 h-4 rounded text-violet-600 accent-violet-600 mt-8">
          <div class="w-20 h-20 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center p-2 shrink-0">
            <img src="https://img.drz.lazcdn.com/g/kf/S099db83293894473b2e78fcc9bd98bbe0.jpg_400x400q75.avif" alt="product image">
          </div>
          <div class="flex-1 min-w-0 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div>
              <h3 class="font-bold text-gray-800 text-sm sm:text-base leading-tight truncate">Patanjali Aloe Vera Gel (150ml)</h3>
              <p class="text-xs text-gray-400 mt-0.5">Gel</p>
              <div class="flex items-baseline gap-2 mt-2">
                <span class="font-bold text-gray-900 text-sm sm:text-base">Rs. 199</span>
                <span class="text-xs text-gray-400 line-through">Rs. 250</span>
              </div>
            </div>
            <div class="flex items-center gap-3 self-end sm:self-center">
              <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                <button class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition font-medium">-</button>
                <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-white">1</span>
                <button class="px-2.5 py-1 text-gray-500 hover:bg-gray-200 transition font-medium">+</button>
              </div>
              <button class="text-gray-300 hover:text-red-500 transition p-1">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="bg-gray-50 p-6 border-t border-gray-100 space-y-4">
      <h4 class="font-bold text-gray-900 text-sm uppercase tracking-wider">Price Details</h4>
      
      <div class="space-y-2.5 text-sm">
        <div class="flex justify-between text-gray-500">
          <span>Subtotal (3 items)</span>
          <span class="font-medium text-gray-800">Rs. 21,597</span>
        </div>
        <div class="flex justify-between text-gray-500">
          <span>Discount</span>
          <span class="font-medium text-emerald-600">- Rs. 2,598</span>
        </div>
        <div class="flex justify-between text-gray-500">
          <span>Delivery Fee</span>
          <span class="font-bold text-emerald-600 text-xs tracking-wide uppercase">Free</span>
        </div>
      </div>

      <hr class="border-gray-200/80 my-3">

      <div class="flex justify-between items-center pb-2">
        <span class="font-bold text-gray-900 text-base">Total Amount</span>
        <span class="font-bold text-violet-700 text-lg sm:text-xl">Rs. 18,999</span>
      </div>

      <button class="w-full bg-violet-600 hover:bg-violet-700 active:bg-violet-800 text-white font-semibold text-center py-3.5 rounded-2xl shadow-md hover:shadow-lg transition duration-200">
        Proceed to Checkout
      </button>
    </div>

  </div>

</body>
</html>
@endsection