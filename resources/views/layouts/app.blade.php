<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header class="bg-light shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            MyShop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        {{ __('products.title') }}
                    </a>
                </li>
                {{-- Добавь другие ссылки при необходимости --}}
            </ul>

            <!-- Language Switch -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">English</a></li>
                    <li><a class="dropdown-item" href="{{ route('locale.switch', 'sk') }}">Slovenčina</a></li>
                </ul>
            </div>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        🛒 {{ __('cart.title') }} ({{ count(session('cart', [])) }})
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="py-4">
    @yield('content')
</main>

<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-0">&copy; {{ date('Y') }} MyShop. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
