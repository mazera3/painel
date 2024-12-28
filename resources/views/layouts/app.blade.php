<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-blue-600 text-blue-800">
        <h1>Meu Blog</h1>
        <h2 class="class="text-4xl font-bold mb-4">Teste</h2>
        <nav class="space-x-4">
            <a href="{{ url('/') }}" class="hover:text-gray-200">Home</a>
            <a href="{{ route('posts.index') }}" class="hover:text-gray-200">Posts</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="bg-gray-800 text-zinc-900 py-8">
        <p class="mt-4">&copy; {{ date('Y') }} Meu Blog</p>
    </footer>
</body>
</html>
