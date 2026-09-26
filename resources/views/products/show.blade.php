@extends('layouts.app')

@section('title', $product->name)

@section('content')

    <img src="{{ $product->image }}" alt="{{ $product->name}}">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><strong>${{ number_format($product->price, 2)}}</strong></p>
    <p>Stock disponible: {{ $product->stock }}</p>

    <form action="{{ route('cart.add', $product) }}" method="POST">
        @csrf
        <button type="submit">Agregar al carrito</button>
    </form>
    
@endsection