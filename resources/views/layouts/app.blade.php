<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Наука та техніка')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Інформаційний новинний веб-сайт Наука та техніка">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a class="logo" href="{{ route('home') }}">Наука<span>Техніка</span></a>
        <nav class="main-nav" id="mainNav">
            <a href="{{ route('home') }}">Головна</a>
            <a href="{{ route('home', ['category' => 'Наука']) }}">Наука</a>
            <a href="{{ route('home', ['category' => 'Техніка']) }}">Техніка</a>
            <a href="{{ route('home', ['category' => 'Космос']) }}">Космос</a>
            <a href="{{ route('home', ['category' => 'IT']) }}">IT</a>
            @auth
                <a href="{{ route('admin.news.index') }}">Адмін-панель</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit;">Вийти</button>
                </form>
            @else
                <a href="{{ route('login') }}">Вхід</a>
            @endauth
        </nav>
        <div class="header-actions">
            <button class="theme-btn" id="themeToggle" type="button">🌙</button>
            <button class="burger" id="burgerBtn" type="button">☰</button>
        </div>
    </div>
</header>

@yield('content')

<footer class="site-footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} «Наука та техніка». Всі права захищено.</p>
    </div>
</footer>

<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
