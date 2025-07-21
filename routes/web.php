<?php

use App\Http\Controllers\Dashboard\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\GudepController;
use App\Http\Controllers\Dashboard\KwarcabController;
use App\Http\Controllers\Dashboard\KwarranController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// admin route
Route::middleware(['auth', RoleMiddleware::class . ':Kwarcab'])->prefix('kwarcab')->name('kwarcab.')->group(function () {
    Route::get('/dashboard', [KwarcabController::class, 'kwarcabDashboard'])->name('dashboard.index');

    Route::controller(KwarcabController::class)->prefix('wilayah')->name('wilayah.')->group(function () {
        Route::get('/', 'regionIndex')->name('index');
        Route::get('/tambah', 'regionCreate')->name('create');
        Route::post('/', 'regionStore')->name('store');
        Route::get('/{region}/edit', 'regionEdit')->name('edit');
        Route::put('/{region}', 'regionUpdate')->name('update');
        Route::delete('/{region}', 'regionDestroy')->name('destroy');
    });

    Route::controller(KwarcabController::class)->prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/', 'penggunaIndex')->name('index');
        Route::get('/tambah', 'penggunaTambah')->name('create');
        Route::post('/simpan', 'penggunaSimpan')->name('store');
    });
});


Route::middleware(['auth', RoleMiddleware::class . ':Kwarran'])->prefix('kwarran')->name('kwarran.')->group(function () {
    Route::get('/dashboard', [KwarranController::class, 'kwarranDashboard'])->name('dashboard.index');

    Route::controller(KwarranController::class)->prefix('gudep')->name('gudep.')->group(function () {
        Route::get('/', 'regionIndex')->name('index');
        Route::get('/tambah', 'regionCreate')->name('create');
        Route::post('/', 'regionStore')->name('store');
        Route::get('/{region}/edit', 'regionEdit')->name('edit');
        Route::put('/{region}', 'regionUpdate')->name('update');
        Route::delete('/{region}', 'regionDestroy')->name('destroy');
    });

    Route::controller(KwarranController::class)->prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/', 'penggunaIndex')->name('index');
        Route::get('/tambah', 'penggunaCreate')->name('create');
        Route::post('/simpan', 'penggunaStore')->name('store');
        Route::get('/{user}/edit', 'penggunaEdit')->name('edit');
        Route::put('/{user}', 'penggunaUpdate')->name('update');
        Route::delete('/{user}', 'penggunaDestroy')->name('destroy');
    });

    // anggota
    Route::controller(KwarranController::class)->prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/', 'anggotaIndex')->name('index');
        Route::get('/tambah', 'anggotaCreate')->name('create');
        Route::post('/simpan', 'anggotaStore')->name('store');
        Route::get('/{anggota}/edit', 'anggotaEdit')->name('edit');
        Route::get('/{anggota}/detail', 'anggotaShow')->name('show');
        Route::put('/{anggota}', 'anggotaUpdate')->name('update');
        Route::delete('/{anggota}', 'anggotaDestroy')->name('destroy');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':Gudep'])->prefix('gudep')->name('gudep.')->group(function () {
    Route::get('/dashboard', [GudepController::class, 'gudepDashboard'])->name('dashboard.index');

    // anggota
    Route::controller(GudepController::class)->prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/', 'anggotaIndex')->name('index');
        Route::get('/tambah', 'anggotaCreate')->name('create');
        Route::post('/simpan', 'anggotaStore')->name('store');
        Route::get('/{anggota}/edit', 'anggotaEdit')->name('edit');
        Route::get('/{anggota}/detail', 'anggotaShow')->name('show');
        Route::put('/{anggota}', 'anggotaUpdate')->name('update');
        Route::delete('/{anggota}', 'anggotaDestroy')->name('destroy');
    });
});
