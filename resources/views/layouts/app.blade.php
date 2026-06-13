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
/* cagetory page css */
        .category-main-block{
            width: 1240px;
            margin: 0 auto;
            /* background-color: #922fe5; */
            padding: 25px;
        }

        .filter-sidebar {
      max-width: 280px;
      background: white;
      border-right: 1px solid #e5e7eb;
      height: 100vh;
      overflow-y: auto;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 20px;
      border-bottom: 1px solid #f3f4f6;
      font-weight: 600;
      color: #111827;
    }

    .section-header::after {
      content: '▼';
      font-size: 0.8rem;
      opacity: 0.6;
    }

    .list-item {
      padding: 10px 20px;
      display: flex;
      align-items: center;
      color: #374151;
      transition: background 0.2s;
    }

    .list-item:hover {
      background: #f9fafb;
    }

    .list-item.active {
      background: #f3f4f6;
      font-weight: 500;
      color: #111827;
    }

    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 20px;
      cursor: pointer;
      user-select: none;
    }

    .price-slider {
      padding: 20px;
    }

    input[type="range"] {
      width: 100%;
      accent-color: #7c3aed;
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
