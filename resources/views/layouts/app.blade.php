<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartzen - Multi Vendor Ecommerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    @include('components.navbar')
    <main class="min-h-screen">
        @yield('content')
    </main>
    @include('components.footer')
</body>
</html>