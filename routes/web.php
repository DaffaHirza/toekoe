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
    Route::get('/penjual/beranda', function () {
        return view('penjual.beranda');
    })->name('penjual.beranda');
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
