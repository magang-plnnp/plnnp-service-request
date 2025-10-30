<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\JenisKendaraanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PermintaanKendaraanController;
use App\Http\Controllers\PermintaanMakananController;
use App\Http\Controllers\SubBidangController;
use Illuminate\Support\Facades\Route;

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
        Route::post('/kendaraan/{id}/acc', [PermintaanKendaraanController::class, 'acc'])->name('kendaraan.acc');
        Route::post('/kendaraan/{id}/tolak', [PermintaanKendaraanController::class, 'tolak'])->name('kendaraan.tolak');
        Route::delete('/kendaraan/{id}', [PermintaanKendaraanController::class, 'destroy'])->name('kendaraan.destroy');
        
        Route::get('/subbidang', [SubBidangController::class, 'index'])->name('subbidang.index');
        Route::post('/subbidang', [SubBidangController::class, 'store'])->name('subbidang.store');
        Route::put('/subbidang/{id}', [SubBidangController::class, 'update'])->name('subbidang.update');
        Route::delete('/subbidang/{id}', [SubBidangController::class, 'destroy'])->name('subbidang.destroy');


        Route::get('/driver', [DriverController::class, 'index'])->name('driver.index');
        Route::post('/driver', [DriverController::class, 'store'])->name('driver.store');
        Route::put('/driver/{id}', [DriverController::class, 'update'])->name('driver.update');
        Route::delete('/driver/{id}', [DriverController::class, 'destroy'])->name('driver.destroy');

        Route::get('/jeniskendaraan', [JenisKendaraanController::class, 'index'])->name('jeniskendaraan.index');
        Route::post('/jeniskendaraan', [JenisKendaraanController::class, 'store'])->name('jeniskendaraan.store');
        Route::put('/jeniskendaraan/{id}', [JenisKendaraanController::class, 'update'])->name('jeniskendaraan.update');
        Route::delete('/jeniskendaraan/{id}', [JenisKendaraanController::class, 'destroy'])->name('jeniskendaraan.destroy');

        Route::get('/makanan', [PermintaanMakananController::class, 'index'])->name('makanan.index');
        Route::post('/makanan/{id}/acc', [PermintaanMakananController::class, 'acc'])->name('makanan.acc');
        Route::post('/makanan/{id}/tolak', [PermintaanMakananController::class, 'tolak'])->name('makanan.tolak');
        Route::delete('/makanan/{id}', [PermintaanMakananController::class, 'destroy'])->name('makanan.destroy');

        Route::get('/sub-bidang', [PermintaanMakananController::class, 'index'])->name('sub-bidang.index');
    });
});
