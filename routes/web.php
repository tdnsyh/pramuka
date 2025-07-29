<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\GudepController;
use App\Http\Controllers\Dashboard\KwarcabController;
use App\Http\Controllers\Dashboard\KwarranController;
use App\Http\Controllers\Public\PublicController;

// landing page
Route::get('/', [PublicController::class, 'publicIndex']);

// kegiatan
Route::controller(PublicController::class)->prefix('kegiatan')->name('kegiatan.')->group(function () {
    Route::get('/', 'kegiatanIndex')->name('index');
    Route::get('/{slug}', 'kegiatanShow')->name('show');
    Route::get('/{slug}/daftar', 'kegiatanDaftar')->name('registrasi');
    Route::post('/{slug}/submit', 'kegiatanSubmit')->name('store');
    Route::get('/pendaftaran/{slug}/berhasil/{kode}', 'kegiatanBerhasil')->name('berhasil');
});

// route auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// kwarcab
Route::middleware(['auth', RoleMiddleware::class . ':Kwarcab'])->prefix('kwarcab')->name('kwarcab.')->group(function () {
    Route::get('/dashboard', [KwarcabController::class, 'kwarcabDashboard'])->name('dashboard.index');

    // route wilayah
    Route::controller(KwarcabController::class)->prefix('wilayah')->name('wilayah.')->group(function () {
        Route::get('/', 'regionIndex')->name('index');
        Route::get('/tambah', 'regionCreate')->name('create');
        Route::post('/', 'regionStore')->name('store');
        Route::get('/{region}/edit', 'regionEdit')->name('edit');
        Route::put('/{region}', 'regionUpdate')->name('update');
        Route::delete('/{region}', 'regionDestroy')->name('destroy');
    });

    // route pengguna
    Route::controller(KwarcabController::class)->prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/', 'penggunaIndex')->name('index');
        Route::get('/tambah', 'penggunaTambah')->name('create');
        Route::post('/simpan', 'penggunaSimpan')->name('store');
    });

    // anggota
    Route::controller(KwarcabController::class)->prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/', 'anggotaIndex')->name('index');
        Route::get('/tambah', 'anggotaCreate')->name('create');
        Route::post('/simpan', 'anggotaStore')->name('store');
        Route::get('/{anggota}/edit', 'anggotaEdit')->name('edit');
        Route::get('/{anggota}/detail', 'anggotaShow')->name('show');
        Route::put('/{anggota}', 'anggotaUpdate')->name('update');
        Route::delete('/{anggota}', 'anggotaDestroy')->name('destroy');
    });

    // kegiatan
    Route::controller(KwarcabController::class)->prefix('kegiatan')->name('kegiatan.')->group(function () {
        Route::get('/', 'kegiatanIndex')->name('index');
        Route::get('/tambah', 'kegiatanCreate')->name('create');
        Route::post('/simpan', 'kegiatanStore')->name('store');
        Route::get('/{kegiatan}/edit', 'kegiatanEdit')->name('edit');
        Route::get('/{kegiatan}/detail', 'kegiatanShow')->name('show');
        Route::put('/{kegiatan}', 'kegiatanUpdate')->name('update');
        Route::delete('/{kegiatan}', 'kegiatanDestroy')->name('destroy');
        Route::post('/{kegiatan}/galeri', 'kegiatanGaleriStore')->name('galeri.store');
        Route::delete('/{kegiatan}/galeri/{galeri}', 'kegiatanGaleriDestroy')->name('galeri.destroy');
    });

    // Profil
    Route::controller(KwarcabController::class)->prefix('profil')->name('profil.')->group(function () {
        Route::get('/', 'profilIndex')->name('index');
        Route::post('/update', 'profilUpdate')->name('update');
    });

    // Keuangan
    Route::controller(KwarcabController::class)->prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/', 'keuanganIndex')->name('index');
    });

    // tentang
    Route::controller(KwarcabController::class)->prefix('tentang')->name('tentang.')->group(function () {
        Route::get('/', 'tentangIndex')->name('index');
    });
});


// route role kwarran
Route::middleware(['auth', RoleMiddleware::class . ':Kwarran'])->prefix('kwarran')->name('kwarran.')->group(function () {
    Route::get('/dashboard', [KwarranController::class, 'kwarranDashboard'])->name('dashboard.index');

    // region
    Route::controller(KwarranController::class)->prefix('gudep')->name('gudep.')->group(function () {
        Route::get('/', 'regionIndex')->name('index');
        Route::get('/tambah', 'regionCreate')->name('create');
        Route::post('/', 'regionStore')->name('store');
        Route::get('/{region}/edit', 'regionEdit')->name('edit');
        Route::put('/{region}', 'regionUpdate')->name('update');
        Route::delete('/{region}', 'regionDestroy')->name('destroy');
    });

    // pengguna
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

    // kegiatan
    Route::controller(KwarranController::class)->prefix('kegiatan')->name('kegiatan.')->group(function () {
        Route::get('/', 'kegiatanIndex')->name('index');
        Route::get('/tambah', 'kegiatanCreate')->name('create');
        Route::post('/simpan', 'kegiatanStore')->name('store');
        Route::get('/{kegiatan}/edit', 'kegiatanEdit')->name('edit');
        Route::get('/{kegiatan}/detail', 'kegiatanShow')->name('show');
        Route::put('/{kegiatan}', 'kegiatanUpdate')->name('update');
        Route::delete('/{kegiatan}', 'kegiatanDestroy')->name('destroy');
        Route::post('/{kegiatan}/galeri', 'kegiatanGaleriStore')->name('galeri.store');
        Route::delete('/{kegiatan}/galeri/{galeri}', 'kegiatanGaleriDestroy')->name('galeri.destroy');
    });

    // Profil
    Route::controller(KwarranController::class)->prefix('profil')->name('profil.')->group(function () {
        Route::get('/', 'profilIndex')->name('index');
        Route::post('/update', 'profilUpdate')->name('update');
    });

    // Keuangan
    Route::controller(KwarranController::class)->prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/', 'keuanganIndex')->name('index');
    });

    // tentang
    Route::controller(KwarranController::class)->prefix('tentang')->name('tentang.')->group(function () {
        Route::get('/', 'tentangIndex')->name('index');
    });
});


// gudep route
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

    // Profil
    Route::controller(GudepController::class)->prefix('profil')->name('profil.')->group(function () {
        Route::get('/', 'profilIndex')->name('index');
        Route::post('/update', 'profilUpdate')->name('update');
    });

    // Keuangan
    Route::controller(GudepController::class)->prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/', 'keuanganIndex')->name('index');
    });

    // Keuangan
    Route::controller(GudepController::class)->prefix('tentang')->name('tentang.')->group(function () {
        Route::get('/', 'tentangIndex')->name('index');
    });
});
