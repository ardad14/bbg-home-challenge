<?php

use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\LocaleController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/locale/{locale}', [LocaleController::class, 'changeLocale'])->name('locale.switch');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::post('/remove/{productId}', [CartController::class, 'remove'])->name('remove');
});

Route::get('/checkout', [OrderController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
