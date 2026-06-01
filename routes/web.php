<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminOrderController;

/*
|--------------------------------------------------------------------------
| HOMEPAGE (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'welcome']);

/*
|--------------------------------------------------------------------------
| USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

});

/*
|--------------------------------------------------------------------------
| ADMIN ORDERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/orders', [AdminOrderController::class, 'index'])
        ->name('admin.orders.index');

    Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.orders.status');

});

/*
|--------------------------------------------------------------------------
| ADMIN PRODUCT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/products', [ProductController::class, 'index'])
        ->name('admin.products.index');

    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('admin.products.create');

    Route::post('/admin/products/store', [ProductController::class, 'store'])
        ->name('admin.products.store');

    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('admin.products.edit');

    Route::put('/admin/products/{id}/update', [ProductController::class, 'update'])
        ->name('admin.products.update');

    Route::delete('/admin/products/{id}/delete', [ProductController::class, 'destroy'])
        ->name('admin.products.destroy');

});

/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| PRODUCT DETAIL (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/products/{id}', [UserProductController::class, 'show'])
    ->name('products.show');

/*
|--------------------------------------------------------------------------
| CART ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart', [CartController::class, 'store'])
        ->name('cart.store');

    Route::delete('/cart/{key}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

});

/*
|--------------------------------------------------------------------------
| CHECKOUT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::post('/checkout', [CartController::class, 'checkout'])
        ->name('checkout');

    Route::match(['get', 'post'], '/checkout/direct', [CartController::class, 'directCheckout'])
        ->name('checkout.direct');

    Route::post('/checkout/process', [CartController::class, 'processCheckout'])
        ->name('checkout.process');

});

/*
|--------------------------------------------------------------------------
| FAVORITE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/favorite', [FavoriteController::class, 'index'])
        ->name('favorite.index');

    Route::post('/favorite', [FavoriteController::class, 'store'])
        ->name('favorite.store');

    Route::delete('/favorite/{key}', [FavoriteController::class, 'destroy'])
        ->name('favorite.destroy');

});

/*
|--------------------------------------------------------------------------
| MY ORDERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/my-orders', [CartController::class, 'orders'])
        ->name('my.orders');

});

require __DIR__.'/auth.php';