<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrackOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/track-order', [TrackOrderController::class, 'index'])->name('track-order');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/review', [CheckoutController::class, 'review'])->name('checkout.review');
Route::post('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
