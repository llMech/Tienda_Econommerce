<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

#Rutas de Productos

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');

Route::get('/productos/{product}', [ProductController::class, 'show'])->name('products.show');

#Rutas de Carrito

Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');

Route::post('/carrito/agregar/{product}', [CartController::class, 'add'])->name('cart.add');

Route::patch('/carrito/actualizar/{productId}', [CartController::class, 'update'])->name('cart.update');

Route::delete('/carrito/eliminarId/{product}', [CartController::class, 'remove'])->name('cart.remove');
