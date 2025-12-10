<?php

use App\Http\Controllers\admin\BerandaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductFilterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\DataPenjualController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\seller\ProductController;
use App\Http\Controllers\seller\BerandaController as SellerBerandaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/filter', [ProductFilterController::class, 'index'])->name('produk.filter');
Route::get('/produk/{id}', [HomeController::class, 'show'])->name('produk.detail');
Route::post('/produk/{id}/review', [HomeController::class, 'storeReview'])->name('produk.review.store');


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

        Route::patch('sellers/{user}/status', [DataPenjualController::class, 'updateStatus'])
            ->name('sellers.updateStatus');

        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

        Route::get('/reports/seller-status', [ReportController::class, 'sellerStatusReport'])->name('reports.sellerStatus');
        Route::get('/reports/seller-by-province', [ReportController::class, 'sellerByProvinceReport'])->name('reports.sellerByProvince');
        Route::get('/reports/products-by-rating', [ReportController::class, 'productsByRatingReport'])->name('reports.productsByRating');
    });
