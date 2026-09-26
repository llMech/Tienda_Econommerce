@extends('layouts.app')

@section('title', 'Pago rechazado')

@section('content')

    <h1>El pago fue rechazado</h1>
    <p>Orden #{{ $order->id }} registrada con estado fallido. puedes revisar tu carrito e intentar de nuevo.</p>
    <a href="{{ route('cart.index') }}">Volver al carrito</a>

@endsection