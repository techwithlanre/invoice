<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
        Route::get('create', [\App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
        Route::post('store', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
        Route::get('edit/{product}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
        Route::put('update/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
        Route::delete('delete/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');
    });

    Route::prefix('customers')->group(function () {
        Route::get('', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
        Route::get('create', [\App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
        Route::post('store', [\App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
        Route::get('edit/{customer}', [\App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('update/{customer}', [\App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
        Route::delete('delete/{customer}', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.delete');
    });

    Route::prefix('product-categories')->group(function () {
        Route::get('', [\App\Http\Controllers\ProductCategoryController::class, 'index'])->name('product.category.index');
        Route::get('create', [\App\Http\Controllers\ProductCategoryController::class, 'create'])->name('product.category.create');
        Route::post('store', [\App\Http\Controllers\ProductCategoryController::class, 'store'])->name('product.category.store');
        Route::get('edit/{productCategory}', [\App\Http\Controllers\ProductCategoryController::class, 'edit'])->name('product.category.edit');
        Route::put('update/{productCategory}', [\App\Http\Controllers\ProductCategoryController::class, 'update'])->name('product.category.update');
        Route::delete('delete/{productCategory}', [\App\Http\Controllers\ProductCategoryController::class, 'destroy'])->name('product.category.delete');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
