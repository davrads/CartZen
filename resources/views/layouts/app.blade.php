<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Cartzen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <style>
        .primary-purple { color: #7C3AED; }
        .bg-primary { background-color: #7C3AED; }
        .bg-primary:hover{
          background-color: #6D28D9;
        }
        .hero-bg {
            background: linear-gradient(135deg, #6D28D9 0%, #8B5CF6 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px  rgba(124 58 237 / 0.12);
        }
/* cagetory page css */
        .category-main-block{
            max-width: 1240px;
            width: 100%;
            margin: 0 auto;
            /* background-color: #922fe5; */
            padding: 25px;
        }

        .filter-sidebar {
      max-width: 280px;
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      height: 100vh;
      overflow-y: auto;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 20px;
      border-bottom: 1px solid #e5e7eb;
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
      background: #f5f3ff;
      color:#7C3AED;
    }

    .list-item.active {
      background: #ede9fe;
      font-weight: 600;
      color: #7C3AED;
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
