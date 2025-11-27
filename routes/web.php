<?php

use App\Http\Controllers\admin\BerandaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\DataPenjualController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\penjual\ProductController;

Route::get('/', function () {
    return view('pages.beranda');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'create']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'create']);

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/penjual/beranda', function () {
        return view('penjual.beranda');
    })->name('penjual.beranda');
    Route::get('/penjual/produk', [ProductController::class, 'index'])->name('penjual.pages.view');
    Route::get('/penjual/produk/create', [ProductController::class, 'create'])->name('penjual.pages.create');
    Route::post('/penjual/produk', [ProductController::class, 'store'])->name('penjual.pages.store');
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
