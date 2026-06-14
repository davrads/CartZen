<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/product/{slug}', [FrontendController::class, 'productShow'])->name('product.show');
Route::get('/vendor-store/{id}', [FrontendController::class, 'vendorStore'])->name('vendor.store');


Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place.order');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [CustomerAuthController::class, 'login']);

    Route::get('/register', [CustomerAuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [CustomerAuthController::class, 'register']);

    Route::get('/auth/google/login', [CustomerAuthController::class, 'googleLogin'])
        ->name('google.login');

    Route::get('/auth/google/register', [CustomerAuthController::class, 'googleRegister'])
        ->name('google.register');

    Route::get('/auth/google/callback', [CustomerAuthController::class, 'handleGoogleCallback'])
        ->name('google.callback');
});

Route::post('/logout', [CustomerAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



Route::get('/category/', function(){
    return view('/frontend.category');
});
