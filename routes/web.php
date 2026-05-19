<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\User;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| HOMEPAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

});

/*
|--------------------------------------------------------------------------
| USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function (Request $request) {

        /*
        |--------------------------------------------------------------------------
        | ADMIN REDIRECT
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->role == 'admin') {

            return redirect('/admin/dashboard');

        }

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        $search = $request->search;

        /*
        |--------------------------------------------------------------------------
        | PRODUCT QUERY
        |--------------------------------------------------------------------------
        */

        $products = Product::query()

            ->when($search, function ($query) use ($search) {

                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('category', 'like', '%' . $search . '%')
                      ->orWhere('color', 'like', '%' . $search . '%');

            })

            ->latest()
            ->get();

        return view(
            'dashboard',
            compact('products')
        );

    })->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {

        /*
        |--------------------------------------------------------------------------
        | TOTAL DATA
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $totalUsers = User::count();

        $totalStock = Product::sum('stock');

        $totalCategory = Product::distinct('category')
            ->count('category');

        /*
        |--------------------------------------------------------------------------
        | SALES
        |--------------------------------------------------------------------------
        */

        $totalSold = Product::sum('sold');

        /*
        |--------------------------------------------------------------------------
        | REVENUE
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Product::selectRaw(
            'SUM(price * sold) as total'
        )->value('total');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalStock',
            'totalCategory',
            'totalSold',
            'totalRevenue'
        ));

    })->name('admin.dashboard');

});

/*
|--------------------------------------------------------------------------
| ADMIN PRODUCT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // PRODUCT LIST
    Route::get(
        '/admin/products',
        [ProductController::class, 'index']
    )->name('admin.products.index');

    // CREATE FORM
    Route::get(
        '/admin/products/create',
        [ProductController::class, 'create']
    )->name('admin.products.create');

    // STORE PRODUCT
    Route::post(
        '/admin/products/store',
        [ProductController::class, 'store']
    )->name('admin.products.store');

    // EDIT PRODUCT
    Route::get(
        '/admin/products/{id}/edit',
        [ProductController::class, 'edit']
    )->name('admin.products.edit');

    // UPDATE PRODUCT
    Route::put(
        '/admin/products/{id}/update',
        [ProductController::class, 'update']
    )->name('admin.products.update');

    // DELETE PRODUCT
    Route::delete(
        '/admin/products/{id}/delete',
        [ProductController::class, 'destroy']
    )->name('admin.products.destroy');

});

/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| PRODUCT DETAIL
|--------------------------------------------------------------------------
*/

Route::get(
    '/products/{id}',
    [UserProductController::class, 'show']
)->name('products.show');

/*
|--------------------------------------------------------------------------
| CART ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // CART PAGE
    Route::get(
        '/cart',
        [CartController::class, 'index']
    )->name('cart.index');

    // ADD TO CART
    Route::post(
        '/cart',
        [CartController::class, 'store']
    )->name('cart.store');

    // DELETE CART ITEM
    Route::delete(
        '/cart/{key}',
        [CartController::class, 'destroy']
    )->name('cart.destroy');

    // CHECKOUT PAGE
    Route::post(
        '/checkout',
        [CartController::class, 'checkout']
    )->name('checkout');

    // DIRECT BUY NOW
    Route::post(
        '/checkout/direct',
        [CartController::class, 'directCheckout']
    )->name('checkout.direct');

    // PROCESS CHECKOUT
    Route::post(
        '/checkout/process',
        [CartController::class, 'processCheckout']
    )->name('checkout.process');

});

/*
|--------------------------------------------------------------------------
| FAVORITE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // FAVORITE PAGE
    Route::get(
        '/favorite',
        [FavoriteController::class, 'index']
    )->name('favorite.index');

    // ADD FAVORITE
    Route::post(
        '/favorite',
        [FavoriteController::class, 'store']
    )->name('favorite.store');

    // DELETE FAVORITE
    Route::delete(
        '/favorite/{key}',
        [FavoriteController::class, 'destroy']
    )->name('favorite.destroy');

});

/*
|--------------------------------------------------------------------------
| MY ORDERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/my-orders',
        [CartController::class, 'orders']
    )->name('my.orders');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';