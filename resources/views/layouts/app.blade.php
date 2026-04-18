<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CaféTrace - Trazabilidad del Café Colombiano')</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/CafeTrace.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/CafeTrace.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/CafeTrace.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-amber-50 to-orange-100 min-h-screen">
    @yield('content')
</body>
</html>