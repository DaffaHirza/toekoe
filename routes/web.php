<?php

use App\Http\Controllers\admin\BerandaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\DataPenjualController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\seller\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk/{id}', [HomeController::class, 'show'])->name('produk.detail');
Route::post('/produk/{id}/review', [HomeController::class, 'storeReview'])->name('produk.review.store');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'create']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'create']);

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/beranda', function () {
        return view('seller.beranda');
    })->name('seller.beranda');
    Route::get('/seller/produk', [ProductController::class, 'index'])->name('seller.pages.view');
    Route::get('/seller/produk/create', [ProductController::class, 'create'])->name('seller.pages.create');
    Route::post('/seller/produk', [ProductController::class, 'store'])->name('seller.pages.store');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/beranda', [BerandaController::class, 'index'])
            ->name('beranda');

        Route::resource('/sellers', DataPenjualController::class);

        Route::patch('sellers/{user}/status', [DataPenjualController::class, 'updateStatus'])
            ->name('sellers.updateStatus');

        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    });
