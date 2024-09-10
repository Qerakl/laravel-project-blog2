<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ mix('js/app.js') }}"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #343a40;
            padding: 10px 20px;
            color: #ffffff;
        }

        .navbar-brand {
            font-size: 1.5rem;
            color: #ffffff;
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: #ffffff;
            text-decoration: none;
            padding: 10px;
        }

        .nav-link:hover {
            background-color: #495057;
            border-radius: 4px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            min-width: 160px;
            z-index: 1000;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            padding: 10px;
            color: #333;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .dropdown-divider {
            border-top: 1px solid #e0e0e0;
            margin: 0;
        }

        .container {
            padding-top: 60px; /* Adjust for fixed navbar */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('post') }}">Блог</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('post') }}">Главная</a>
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('post/create') }}">Создать пост</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('follow')}}">Подписки</a>
                    </li>
                    @endif
                </ul>
                <form class="d-flex me-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                    <button class="btn btn-outline-light" type="submit">Поиск</button>
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="dropdownMenuButton"> {{ session('user.name') }} </a>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a class="dropdown-item" href="{{ url('profile/' . session('user.id')) }}">Профиль</a>
                            <a class="dropdown-item" href="{{ url('settings') }}">Настройки</a>
                            <a class="dropdown-item" href="{{ url('profile/edit/' . session('user.id')) }}">Редактировать профиль </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('logout') }}">Выйти</a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('logup') }}">Зарегистрироваться</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">Войти</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-4">
        @yield('content')
    </div>

    <!-- Подвал -->
    <footer class="text-center py-4">
        <p>&copy; 2024 Блог. Все права защищены.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownButton = document.getElementById('dropdownMenuButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            dropdownButton.addEventListener('click', function () {
                dropdownMenu.classList.toggle('show');
            });

            window.addEventListener('click', function (event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>
