<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="autocomplete" content="off">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Usuarios')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
    <!--FONTS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="py-4">
            <svg width="150" height="80" viewBox="0 0 150 80" xmlns="http://www.w3.org/2000/svg">
                <text x="10" y="50" font-family="Arial, sans-serif" font-size="40" font-weight="bold" fill="#333">{J3}</text>
            </svg>
        </header>

        <main class="container py-4">
            @yield('content')
        </main>

        <footer class="py-4 text-center p-1">
            <p class="mb-0">Empoderado por<a href="https://www.linkedin.com/in/miguelrojasoficial/" class="text-decoration-none" target="_blank"> <strong>MigueRojas</strong></a> | &copy; Todos los derechos reservados</p>
        </footer>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
