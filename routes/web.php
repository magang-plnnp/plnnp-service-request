<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/test', function () {
    return 'Hello, Laravel!';
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Tabel permintaan kendaraan
    Route::get('/makanan', function () {
        return view('manajemen-data.makanan.index');
    })->name('makanan.index');

    Route::get('/kendaraan', function () {
        return view('manajemen-data.kendaraan.index');
    })->name('kendaraan.index');
});
