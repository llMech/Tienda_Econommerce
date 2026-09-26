<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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

#Rutas de Checkout


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/{order}/exito', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/{order}/fallido', [CheckoutController::class, 'failed'])->name('checkout.failed');