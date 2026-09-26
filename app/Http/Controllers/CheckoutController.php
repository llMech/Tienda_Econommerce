<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_address' => 'required|string|max:255',
            'card_number' => 'required|digits:16',
            'card_expiry' => 'required|string',
            'card_cvv' => 'required|digits:3',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        // Simulación de pasarela: si la tarjeta termina en un número par, aprueba; si no, rechaza.
        $paymentApproved = (int) substr($validated['card_number'], -1) % 2 === 0;

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_address' => $validated['customer_address'],
            'total' => $total,
            'status' => $paymentApproved ? 'paid' : 'failed',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        if ($paymentApproved) {
            session()->forget('cart');
            return redirect()->route('checkout.success', $order)->with('success', '¡Pago aprobado!');
        }

        return redirect()->route('checkout.failed', $order)->with('error', 'Pago rechazado por la pasarela.');
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }

    public function failed(Order $order)
    {
        return view('checkout.failed', compact('order'));
    }
}