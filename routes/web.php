<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Vendor\VendorRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;



Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/vendor-store', function () {
    return view('frontend.vendor-store');
});


Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])
        ->name('categories.index');
    Route::get('/{category}', [CategoryController::class, 'show'])
        ->name('categories.show');
});


// Route::prefix('checkout')->group(function () {
//     Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
//     Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place.order');
// });

// Khalti callback – must be public (no auth middleware)
Route::get('/khalti/verify', [CheckoutController::class, 'verifyKhalti'])->name('khalti.verify');

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

Route::prefix('vendor')->name('vendor.')->group(function () {

    Route::get('/request', [VendorRequestController::class, 'create'])
        ->name('request');

    Route::post('/request', [VendorRequestController::class, 'store'])
        ->name('request.store');

    Route::get('/submitted', [VendorRequestController::class, 'submitted'])
        ->name('submitted');
});

Route::middleware('customer')->group(function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');


  Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
    Route::get('/khalti/callback', [OrderController::class, 'callback'])->name('khalti.callback');
     Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
});


    Route::get('/user_profile', function () {
        return view('profile.user_profile');
    })->name('profile');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');

    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::get('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    });

    Route::post('/logout', [CustomerAuthController::class, 'logout'])
        ->name('logout');
});

