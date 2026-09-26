@extends('layouts.app')

@section('title', 'Pago exitoso')

@section('content')
    <h1>¡Gracias por tu compra, {{ $order->customer_name }}!</h1>
    <p>Orden #{{ $order->id }} — Total: ${{ number_format($order->total, 2) }}</p>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->product_name }} x{{ $item->quantity }} — ${{ number_format($item->price * $item->quantity, 2) }}</li>
        @endforeach
    </ul>
@endsection