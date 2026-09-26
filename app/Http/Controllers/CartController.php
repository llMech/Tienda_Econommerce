<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito');
    }

    public function update(Request $request, int $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index');
    }

    public function remove(int $productId)
    {
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Producto eliminado');
    }
}