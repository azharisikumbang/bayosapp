<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\VariantGroupController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});

require __DIR__.'/auth.php';
