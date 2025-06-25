<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PerhitunganController;

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

/*
|--------------------------------------------------------------------------
| Halaman Dashboard - Hanya untuk user yang login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Manajemen Alternatif
    |--------------------------------------------------------------------------
    */
    Route::prefix('alternatif')->name('alternatif.')->group(function () {
        Route::get('/', [AlternatifController::class, 'index'])->name('index');
        Route::get('/create', [AlternatifController::class, 'create'])->name('create');
        Route::post('/', [AlternatifController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AlternatifController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AlternatifController::class, 'update'])->name('update');
        Route::delete('/{id}', [AlternatifController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Manajemen Kriteria
    |--------------------------------------------------------------------------
    */
    Route::prefix('kriteria')->name('kriteria.')->group(function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('index');
        Route::get('/create', [KriteriaController::class, 'create'])->name('create');
        Route::post('/', [KriteriaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KriteriaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KriteriaController::class, 'update'])->name('update');
        Route::delete('/{id}', [KriteriaController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Manajemen Penilaian
    |--------------------------------------------------------------------------
    */
    Route::prefix('penilaian')->name('penilaian.')->group(function () {
        Route::get('/', [PenilaianController::class, 'index'])->name('index');
        Route::get('/create', [PenilaianController::class, 'create'])->name('create');
        Route::post('/', [PenilaianController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PenilaianController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PenilaianController::class, 'update'])->name('update');
        Route::delete('/{id}', [PenilaianController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | (Opsional) Halaman Perhitungan / Pemberian Sanksi
    |--------------------------------------------------------------------------
    */
    Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan');
});
