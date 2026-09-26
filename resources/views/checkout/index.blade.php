@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <h1>Finalizar compra</h1>
    <p>Total a pagar: ${{ number_format($total, 2) }}</p>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <label>Nombre completo</label>
        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required>
        @error('customer_name') <p>{{ $message }}</p> @enderror

        <label>Correo electrónico</label>
        <input type="email" name="customer_email" value="{{ old('customer_email') }}" required>
        @error('customer_email') <p>{{ $message }}</p> @enderror

        <label>Dirección de envío</label>
        <input type="text" name="customer_address" value="{{ old('customer_address') }}" required>
        @error('customer_address') <p>{{ $message }}</p> @enderror

        <hr>
        <p>Datos de pago (simulado)</p>

        <label>Número de tarjeta (16 dígitos)</label>
        <input type="text" name="card_number" maxlength="16" required>
        @error('card_number') <p>{{ $message }}</p> @enderror

        <label>Vencimiento (MM/AA)</label>
        <input type="text" name="card_expiry" placeholder="12/28" required>

        <label>CVV</label>
        <input type="text" name="card_cvv" maxlength="3" required>
        @error('card_cvv') <p>{{ $message }}</p> @enderror

        <button type="submit">Pagar</button>
    </form>
@endsection