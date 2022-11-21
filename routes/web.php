<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\VariantGroupController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProductCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// public page
Route::get('/', [HomeController::class, 'index']);
Route::get('/p/{product:slug}', [ProductDetailController::class, '__invoke']);
// Route::put('/cart/{product}/update', [UpdateCartItemQuantityController::class, '__invoke'])->name('cart.product.update');
Route::resource('/cart', CartController::class);
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// customer page 


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// customer page
Route::group([
    'prefix' => 'user', 
    'as' => 'user', 
    'middleware' => ['auth', 'verified']
], function() { 
    // user setting page
    Route::get('settings', [UserSettingController::class, 'index'])->name('.setting.index');
    Route::get('settings/edit', [UserSettingController::class, 'edit'])->name('.setting.edit');
    Route::put('settings', [UserSettingController::class, 'update'])->name('.setting.update');

    // user order page
    Route::get('orders', [UserOrderController::class, 'index'])->name('.order.index');
    Route::get('orders/{order:order_number}', [UserOrderController::class, 'show'])->name('.order.show');
});

// super-admin routes
Route::group(['prefix' => 'backend', 'as' => 'backend'], function() {
    Route::get('/welcome', function() {
        return Inertia::render('Backend/Welcome');
    })->name('.welcome');

    Route::resource('/users', UserManagementController::class)
        ->names('-users');
});

// adminitrator routes
Route::group(['prefix' => 'admin', 'as' => 'admin'], function() {
    Route::get('/dashboard', function() {
        return Inertia::render('Admin/Dashboard');
    })->name('.dashboard');

    // Product Category Routes
    Route::resource('product-categories', ProductCategoryController::class)->names('-product-category');
    Route::resource('product-variant-groups', VariantGroupController::class)->names('-product-variant-group');
    Route::resource('product-variants', VariantController::class)->names('-product-variant');
    Route::resource('products', ProductController::class)->names('-product');

    Route::get('skus', [SkuController::class, 'index'])->name('-sku.index');
    // Route::get('skus/{product}', [SkuController::class, 'store'])->name('-sku.store');
    Route::post('skus/{product}', [SkuController::class, 'store'])->name('-sku.store');
    // Route::resource('skus', SkuController::class)->names('-sku');
});

require __DIR__.'/auth.php';
