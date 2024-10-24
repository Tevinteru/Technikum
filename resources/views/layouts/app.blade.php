<!DOCTYPE html>
<html class="h-100" lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ангарский политехнический техникум')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mx-3 mb-1" href="{{ route('home') }}">Техникум</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">О техникуме</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Контакты</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('teachers.index') }}">Преподаватели</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('students.index') }}">Студенты</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('excel.form') }}">Excel</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <main>
            @yield('content')
        </main>
    </div>

    <footer class="footer bg-light text-center py-3 mt-auto">
        <p>© 2024 Ангарский политехнический техникум!</p>
    </footer>

</body>
</html>