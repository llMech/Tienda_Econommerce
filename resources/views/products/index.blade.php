@extends('layouts.app')

@section('title', 'Catálogo de productos')

@section('content')

    <div class="grid">
        @foreach ($products as $product)
        <div class=card>
            <img src="{{$product->image}}" alt="{{ $product->name }}">
            <h3>{{$product->name}}</h3>
            <p>${{ number_format($product->price, 2)}}</p>
            <a href="{{ route('products.show', $product) }}">Ver detalles</a>
        </div>
        @endforeach
    </div>

    {{ $products->links() }}

@endsection