<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartzen - Multi Vendor Ecommerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
    </style>    
    
</head>
<body class="bg-gray-50 font-sans antialiased">
    @include('components.navbar')
    <main class="min-h-screen">
        @yield('content')
    </main>
    @include('components.footer')
</body>
</html>