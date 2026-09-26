@extends('layouts.app')

@section('title', 'Mi Carrito')

@section('content')
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (empty($cart))
        <p>Tu carrito está vacío.</p>
    @else
        @php $total = 0; @endphp

        @foreach ($cart as $productId => $item)
            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
            <div class="cart-item">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                <h4>{{ $item['name'] }}</h4>
                <p>${{ number_format($item['price'], 2) }}</p>

                <form action="{{ route('cart.update', $productId) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                    <button type="submit">Actualizar</button>
                </form>

                <p>Subtotal: ${{ number_format($subtotal, 2) }}</p>

                <form action="{{ route('cart.remove', $productId) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        @endforeach

        <h3>Total: ${{ number_format($total, 2) }}</h3>
        
{{--         <a href="{{ route('checkout.index') }}">Proceder al pago</a> --}}
    @endif
@endsection