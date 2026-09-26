<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-commerce')</title>
    @vite('resources/css/app.css')      
</head>
<body>

    <nav>
        <a href="{{ route('products.index') }}">Catálogo</a>    
        <a href="{{ route('cart.index') }}">
            Carrito ({{ collect(session('cart', []))->sum('quantity') }})
        </a>
    </nav>

    <main>
        @yield('content')
    </main>
    
</body>
</html>