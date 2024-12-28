<html>

<head>
    <title>{{ $title ?? 'Website' }}</title>
    <link rel="stylesheet" href="{{ asset('/css/tutorial.css') }}">
</head>

<body>
    <nav>
        <h3>Bem vindo to my website</h3>
        <hr>
    </nav>
    {{ $slot }}
    <footer>
        <hr />
        © 2023 example.com
    </footer>
</body>

</html>
