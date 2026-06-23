<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\AddressController; 
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/vendor-store', function () {
    return view('frontend.vendor-store');
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])
        ->name('categories.index');
    Route::get('/{category}', [CategoryController::class, 'show'])
        ->name('categories.show');
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

Route::middleware('auth')->group(function () {

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show');

    Route::get('/user_profile', function () {
        return view('profile.user_profile');
    })->name('profile');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');

    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])
            ->name('cart.index');
    });



    Route::post('/logout', [CustomerAuthController::class, 'logout'])
        ->name('logout');
});













