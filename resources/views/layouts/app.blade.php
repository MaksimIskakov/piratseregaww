<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Грузовозофф - @yield('title')</title>
    @vite('resources/css/styles.css')
</head>
<body>
<header>
    <div class="container">
        <h1>Грузовозофф</h1>
        <nav>
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}">Панель администратора</a>
                @endif
            {{ Auth::user()->full_name }}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}">Войти</a>
                <a href="{{ route('register') }}">Регистрация</a>
            @endauth
        </nav>
    </div>
</header>

<main class="container">
    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif
    @yield('content')
</main>

<footer>
    <div class="container">
        <p>&copy; Грузовозофф {{ date('Y') }}</p>
    </div>
</footer>
</body>
</html>
