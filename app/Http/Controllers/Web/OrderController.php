<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function show(): View|RedirectResponse
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', __('checkout.empty'));
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', __('checkout.empty'));
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        try {
            DB::beginTransaction();

            $order = Order::create([
                'customer_name' => $validated['name'],
                'customer_email' => $validated['email'],
                'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            ]);

            foreach ($cart as $item) {
                $order->items()->create([
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            DB::commit();
            Session::forget('cart');

            return redirect()->route('products.index')->with('success', __('checkout.success'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', __('checkout.error'))->withInput();
        }
    }
}

