<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Cartzen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <style>
        .primary-purple { color: #7C3AED; }
        .bg-primary { background-color: #7C3AED; }
        .hero-bg { 
            background: linear-gradient(135deg, #6B46C1 0%, #7C3AED 100%); 
        }
        .card-hover:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 20px 25px -5px rgb(124 58 237 / 0.15); 
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    @include('partials.topbar')
    @include('components.navbar')

    @yield('content')

    @include('components.footer')
</body>
</html>