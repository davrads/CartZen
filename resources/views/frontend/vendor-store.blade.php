
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
        <div class="text-gray-700 cursor-pointer hover:text-violet-600">All Products</div>
        <div class="text-gray-700 cursor-pointer hover:text-violet-600">Headphones</div>
        <div class="text-gray-700 cursor-pointer hover:text-violet-600">Speakers</div>
        <div class="text-gray-700 cursor-pointer hover:text-violet-600">Smartwatches</div>
        <div class="text-gray-700 cursor-pointer hover:text-violet-600">Accessories</div>
      </div>

</div>





    <!-- Main Content -->
    <div class="flex-1">
      <div class="bg-white border-b px-6 py-5 flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold">All Products</h1>
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

          <!-- Vendor Card 1 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <img src="https://www.kroger.com/product/images/xlarge/front/0081006114507"
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

          <!-- Vendor Card 2 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <img src="https://spadeandco.com/cdn/shop/t/217/assets/hsw4-black-34l.png?v=7053232540571629471781119254"
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

          <!-- Vendor Card 3 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/airpods-4-select-202409_FV1?wid=976&hei=916&fmt=jpeg&qlt=90&.v=WnVKRVRUTFVsYThXaWkydWViL1Q3ZDZGTE9TV3RDcGJJclBqdUtzdTJYYjNHc3NlSmU2dzJyR1kxZEwyTE1neUJkRlpCNVhYU3AwTldRQldlSnpRa0NZZXAxWFNjRXhITDI1RVE5YVpyU0E"
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

          <!-- Vendor Card  4 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <img src="https://nebo.acgbrands.com/en_US/media/catalog/product/d/8/d83cc1b40cd25217fceca724c6f4f771855399c45e2df2d05d4a0b7bea2407d5.jpeg?optimize=high&bg-color=255,255,255&fit=bounds&height=&width="
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



          <!-- Vendor Card 5 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <img src="https://www.mystore.in/s/62ea2c599d1398fa16dbae0a/g/6a22cd5d5bacad49ab12a463/71akladwytl-_sx522_.jpg"
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

          <!-- Vendor Card 6 -->
          <div class="product-card bg-white rounded-2xl overflow-hidden border">
            <div class="relative">
              <img src="https://i5.walmartimages.com/seo/990000-Lumen-LED-Rechargeable-Headlamp-60H-Long-Battery-Life-Head-Lamp-5-Modes-IPX7-Waterproof-Zoomable-120-Adjustable-Head-Light-Adults-Outdoor-Camp_4d7b576a-6395-40d9-ab05-27e41e62070e.5592180346961c15daad93399a1ad020.jpeg?odnHeight=573&odnWidth=573&odnBg=FFFFFF"
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
