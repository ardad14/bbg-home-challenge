<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        try {
            $cart = Session::get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
                $cart[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image_url' => $product->image_url,
                ];
            }

            Session::put('cart', $cart);

            return back()->with('success', __('cart.added'));
        } catch (\Throwable $e) {
            return back()->with('error', __('cart.error_add'));
        }
    }

    public function remove(Request $request, $productId): RedirectResponse
    {
        try {
            $cart = Session::get('cart', []);
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                Session::put('cart', $cart);
                return back()->with('success', __('cart.removed'));
            }

            return back()->with('error', __('cart.not_found'));
        } catch (\Throwable $e) {
            return back()->with('error', __('cart.error_remove'));
        }
    }
}

