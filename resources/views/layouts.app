<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 text-gray-900">
    <header class="p-4 bg-blue-600 text-white">
        <div class="container mx-auto">
            <h1 class="text-lg font-bold">Meu Blog</h1>
        </div>
    </header>
    <main class="container mx-auto p-4">
        @yield('content')
    </main>
    <footer class="p-4 bg-gray-800 text-white">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} Meu Blog. Todos os direitos reservados.
        </div>
    </footer>
</body>
</html>
