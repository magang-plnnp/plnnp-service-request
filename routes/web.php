<?php

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

// Route::get('/', function () {
//     return view('dashboard.index');
// });
// Route::get('/makanan', function () {
//     return view('manajemen-data.makanan.index');
// });
// Route::get('/kendaraan', function () {
//     return view('manajemen-data.kendaraan.index');
// });

Route::get('/', function () {
    return view('landing.index');
})->name('landing');

Route::get('/auth/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/test', function () {
    return 'Hello, Laravel!';
});
Route::prefix('admin')->name('admin.')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Tabel permintaan kendaraan
    Route::get('/makanan', function () {
        return view('manajemen-data.makanan.index');
    })->name('makanan.index');

    Route::get('/kendaraan', function () {
        return view('manajemen-data.kendaraan.index');
    })->name('kendaraan.index');

    //  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // // Tabel permintaan kendaraan
    // Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
    // Route::get('/kendaraan/{id}', [KendaraanController::class, 'show'])->name('kendaraan.show');
    // Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy');

    // // Tabel permintaan makanan
    // Route::get('/makanan', [MakananController::class, 'index'])->name('makanan.index');
    // Route::get('/makanan/{id}', [MakananController::class, 'show'])->name('makanan.show');
    // Route::delete('/makanan/{id}', [MakananController::class, 'destroy'])->name('makanan.destroy');
});
