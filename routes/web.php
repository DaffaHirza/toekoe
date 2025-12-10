<?php

use App\Http\Controllers\admin\BerandaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\DataPenjualController;


Route::get('/', function () {
    return view('pages.beranda');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'create']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'create']);

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/beranda', [SellerBerandaController::class, 'index'])->name('seller.beranda');
    Route::get('/seller/produk', [ProductController::class, 'index'])->name('seller.pages.view');
    Route::get('/seller/produk/create', [ProductController::class, 'create'])->name('seller.pages.create');
    Route::post('/seller/produk', [ProductController::class, 'store'])->name('seller.pages.store');
    Route::get('/seller/produk/{id}/edit', [ProductController::class, 'edit'])->name('seller.pages.edit');
    Route::put('/seller/produk/{id}', [ProductController::class, 'update'])->name('seller.pages.update');
    Route::delete('/seller/produk/{id}', [ProductController::class, 'destroy'])->name('seller.pages.destroy');

    // Seller PDF reports
    Route::get('/seller/reports/stock-by-stock', [\App\Http\Controllers\seller\ReportController::class, 'stockByStockReport'])->name('seller.reports.stockByStock');
    Route::get('/seller/reports/stock-by-rating', [\App\Http\Controllers\seller\ReportController::class, 'stockByRatingReport'])->name('seller.reports.stockByRating');
    Route::get('/seller/reports/low-stock', [\App\Http\Controllers\seller\ReportController::class, 'lowStockReport'])->name('seller.reports.lowStock');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/beranda', [BerandaController::class, 'index'])
            ->name('beranda');

        Route::resource('/sellers', DataPenjualController::class);

        // Custom route to update seller's status (uses enum: pending, approved, rejected)
        Route::patch('sellers/{user}/status', [DataPenjualController::class, 'updateStatus'])
            ->name('sellers.updateStatus');

        // Convenience toggle route (approve <-> pending)
        Route::post('sellers/{user}/toggle-status', [DataPenjualController::class, 'toggleStatus'])
            ->name('sellers.toggleStatus');
    });
