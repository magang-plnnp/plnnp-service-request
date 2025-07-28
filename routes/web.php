<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PermintaanKendaraanController;
use App\Http\Controllers\PermintaanMakananController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/auth/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/auth/login', [AuthController::class, 'login']);
});

Route::post('/permintaan-makanan', [PermintaanMakananController::class, 'store'])->name('permintaan-makanan.store');
Route::post('/permintaan-kendaraan', [PermintaanKendaraanController::class, 'store'])->name('permintaan-kendaraan.store');


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/kendaraan', [PermintaanKendaraanController::class, 'index'])->name('kendaraan.index');
        Route::get('/makanan', [PermintaanMakananController::class, 'index'])->name('makanan.index');
        Route::get('/sub-bidang', [PermintaanMakananController::class, 'index'])->name('sub-bidang.index');
    });
});
