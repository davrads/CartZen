
@extends('layouts.app')
@section('content')

<style>
    .category-main-block-section{
        widows: 1240px;
        margin: 0 auto;
    }


</style>

</head>
<body class="bg-gray-50 min-h-screen py-4 sm:py-8 px-4">

<!-- category page block -->
<section class="category-main-block">

    <div class="flex min-h-screen">

    <!-- Sidebar (Same as before) -->
    <div class="w-72 bg-white border-r border-gray-200 p-6 hidden lg:block">
      <!-- Filter content remains the same as previous version -->
      <h2 class="text-xl font-semibold mb-6">Categories</h2>
      <div class="space-y-3 mb-8">
        <div class="font-medium text-violet-600">All</div>
        <div class="text-gray-700 cursor-pointer hover:text-violet-600">Mobiles</div>
        <div class="text-gray-700 cursor-pointer hover:text-violet-600">Tablets</div>
        <div class="text-gray-700 cursor-pointer hover:text-violet-600">Accessories</div>
      </div>

      <h2 class="text-xl font-semibold mb-4">Brand</h2>
      <div class="space-y-3 mb-6">
        <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Samsung</label>
        <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Apple</label>
        <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Xiaomi</label>
        <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> OnePlus</label>
        <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Realme</label>
        <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="w-5 h-5 accent-violet-600"> Vivo</label>
      </div>

      <h2 class="text-xl font-semibold mb-4 mt-10">Price Range</h2>
      <input type="range" min="0" max="60000" value="30000" class="w-full accent-violet-600">
      <div class="flex justify-between text-sm text-gray-600 mt-2">
        <span>Rs. 0</span>
        <span>Rs. 60,000</span>
      </div>
      <button class="mt-6 w-full bg-violet-600 hover:bg-violet-700 text-white py-3 rounded-xl font-medium">Apply</button>
    </div>

    <!-- Main Content -->
    <div class="flex-1">
      <div class="bg-white border-b px-6 py-5 flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold">Mobiles & Tablets</h1>
          <p class="text-gray-500">1200+ products</p>
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

          <!-- Product Card Example 1 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <div class="discount-badge absolute top-4 left-4">-10%</div>
              <img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcTcghfvms9Ye9O9LZPvnx6YxMaMmC4OOQLHuevRZ4lY_FBCjL9nSlGMhyppxbP6K8elPSncE-rUwfqJ8qz_ydPZAf20AxdL_D_M3vvrY2k8qP-zQ6SnsbWXmNcL89Z9Vzop_NmVFgNyKyk&usqp=CAc"
                   class="w-full h-80 object-contain bg-gray-50 p-8">
            </div>
            <div class="p-5">
              <h3 class="font-medium text-lg text-gray-800">Samsung Galaxy A14</h3>
              <div class="mt-3 flex items-center gap-2">
                <span class="text-2xl font-bold text-gray-900">Rs. 18,999</span>
                <span class="text-gray-400 line-through text-lg">Rs. 20,999</span>
              </div>
              <div class="flex items-center gap-1 mt-3">
                <span class="text-yellow-400 text-xl">★★★★☆</span>
                <span class="text-gray-500 text-sm">(138)</span>
              </div>
            </div>
          </div>

          <!-- Product Card Example 2 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <div class="discount-badge absolute top-4 left-4">-12%</div>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR56lM9UbRZPlYmEy65MzTFjn1-s6OxM5Z9PTvC3ywxKIhf80osW9c8G8g&s=10"
                   class="w-full h-80 object-contain bg-gray-50 p-8">
            </div>
            <div class="p-5">
              <h3 class="font-medium text-lg text-gray-800">Xiaomi Redmi Note 13</h3>
              <div class="mt-3 flex items-center gap-2">
                <span class="text-2xl font-bold text-gray-900">Rs. 23,499</span>
                <span class="text-gray-400 line-through text-lg">Rs. 26,999</span>
              </div>
              <div class="flex items-center gap-1 mt-3">
                <span class="text-yellow-400 text-xl">★★★★☆</span>
                <span class="text-gray-500 text-sm">(180)</span>
              </div>
            </div>
          </div>

          <!-- Product Card Example 3 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <div class="discount-badge absolute top-4 left-4">-8%</div>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEN7nbwThD5XpJNzetXnoYbNk_pFAOpaVkLePJ9SHbtg&s=10"
                   class="w-full h-80 object-contain bg-gray-50 p-8">
            </div>
            <div class="p-5">
              <h3 class="font-medium text-lg text-gray-800">Realme C67</h3>
              <div class="mt-3 flex items-center gap-2">
                <span class="text-2xl font-bold text-gray-900">Rs. 17,999</span>
                <span class="text-gray-400 line-through text-lg">Rs. 19,499</span>
              </div>
              <div class="flex items-center gap-1 mt-3">
                <span class="text-yellow-400 text-xl">★★★★☆</span>
                <span class="text-gray-500 text-sm">(76)</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</section>





</body>
</html>
@endsection
