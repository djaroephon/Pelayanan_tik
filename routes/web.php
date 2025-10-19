<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\admin\GuestAdminController;
use App\Http\Controllers\Admin\kategoriController;
use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Admin\PenjabController;
use App\Http\Controllers\Admin\RelokasiAdminController;
use App\Http\Controllers\Admin\TeknisiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Export\ExportController;
use App\Http\Controllers\GuestAuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RelokasiController;
use App\Http\Controllers\Teknisi\TeknisiLaporController;
use App\Http\Middleware\CheckRole;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:guest'])->group(function () {
    Route::get('/guest/home', [GuestAuthController::class, 'home'])->name('guest.home');
    Route::get('/lapor', [LaporanController::class, 'Getform'])->name('pages.form');
    Route::post('/lapor', [LaporanController::class, 'SubmitForm'])->name('lapor.submit');
    Route::get('/laporan-saya', [GuestAuthController::class, 'laporanSaya'])->name('guest.laporan.saya');

    Route::get('/relokasi/create', [RelokasiController::class, 'create'])->name('relokasi.create');
    Route::post('/relokasi', [RelokasiController::class, 'store'])->name('relokasi.store');
    Route::get('/relokasi', [RelokasiController::class, 'index'])->name('relokasi.index');
});

// Route guest auth
Route::prefix('guest')->group(function () {
    Route::get('/login', [GuestAuthController::class, 'showLoginForm'])->name('guest.login');
    Route::post('/login', [GuestAuthController::class, 'login']);
    Route::get('/register', [GuestAuthController::class, 'showRegistrationForm'])->name('guest.register');
    Route::post('/register', [GuestAuthController::class, 'register']);
    Route::post('/logout', [GuestAuthController::class, 'logout'])->name('guest.logout');
    Route::get('/download-template', [GuestAuthController::class, 'downloadTemplate'])->name('guest.download.template');

});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', CheckRole::class.':admin,operator'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/export-laporan', [ExportController::class, 'exportXlsx'])->name('export.laporan');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/wilayah', [WilayahController::class, 'index'])->name('wilayah.index');
    // Route::get('/wilayah/create', [WilayahController::class, 'create'])->name('wilayah.create');
    Route::post('/wilayah', [WilayahController::class, 'store'])->name('wilayah.store');
    Route::get('/wilayah/{id}/edit', [WilayahController::class, 'edit'])->name('wilayah.edit');
    Route::put('/wilayah/{id}', [WilayahController::class, 'update'])->name('wilayah.update');
    Route::delete('/wilayah/{id}', [WilayahController::class, 'destroy'])->name('wilayah.destroy');
    // Route::get('/penjab', [PenjabController::class, 'index'])->name('penjab.index');
    // Route::post('/penjab', [PenjabController::class, 'store'])->name('penjab.store');
    // Route::put('/penjab/{id}', [PenjabController::class, 'update'])->name('penjab.update');
    // Route::delete('/penjab/{id}', [PenjabController::class, 'destroy'])->name('penjab.destroy');

    Route::get('/guests', [GuestAdminController::class, 'index'])->name('admin.guests.index');
    Route::post('/guests/approve/{id}', [GuestAdminController::class, 'approve'])->name('admin.guests.approve');
    Route::post('/guests/reject/{id}', [GuestAdminController::class, 'reject'])->name('admin.guests.reject');
    Route::get('/admin/documents/{filename}', [GuestAdminController::class, 'showDocument'])
        ->name('admin.documents.show');

    Route::get('/admin/ktp/{filename}', [GuestAdminController::class, 'showKtp'])
        ->name('admin.ktp.show');

    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    Route::get('/teknisi', [TeknisiController::class, 'index'])->name('teknisiAdmin.index');
    Route::put('/teknisi/{id}', [TeknisiController::class, 'update'])->name('teknisiAdmin.update');
    Route::delete('/teknisi/{id}', [TeknisiController::class, 'destroy'])->name('teknisiAdmin.destroy');

    Route::get('/laporan', [LaporanAdminController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}/edit', [LaporanAdminController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{laporan}', [LaporanAdminController::class, 'update'])->name('laporan.update');

    Route::get('/relokasi', [RelokasiAdminController::class, 'index'])->name('admin.relokasi.index');
    Route::get('/relokasi/{relokasi}/edit', [RelokasiAdminController::class, 'edit'])->name('admin.relokasi.edit');
    Route::put('/relokasi/{relokasi}', [RelokasiAdminController::class, 'update'])->name('admin.relokasi.update');
    Route::delete('/relokasi/{relokasi}', [RelokasiAdminController::class, 'destroy'])->name('admin.relokasi.destroy');
});

Route::middleware(['auth', CheckRole::class.':teknisi'])->name('teknisi.')->prefix('teknisi')->group(function () {
    Route::get('/laporan', [TeknisiLaporController::class, 'index'])->name('index');
    Route::get('/laporan/{laporan}/edit', [TeknisiLaporController::class, 'edit'])->name('edit');
    Route::put('/laporan/{laporan}', [TeknisiLaporController::class, 'update'])->name('update');
    Route::get('/layanan', [TeknisiLaporController::class, 'Layanan'])->name('layanan');

});

Route::middleware(['auth', CheckRole::class.':penjab'])->group(function () {
    Route::get('/penjab/dashboard', [PenjabController::class, 'index'])->name('penjab.dashboard');
    Route::get('/penjab/layanan/{id}/teknisis', [PenjabController::class, 'layananTeknisis'])->name('penjab.layanan.teknisis');
    Route::get('/penjab/layanan/{id}/laporans', [PenjabController::class, 'layananLaporans'])->name('penjab.layanan.laporans');
    Route::get('/penjab/laporan', [PenjabController::class, 'laporan'])->name('penjab.laporan');
    Route::get('/penjab/laporan/{id}', [PenjabController::class, 'laporanDetail'])->name('penjab.laporan.detail');
    Route::get('/penjab/layanan/{id}/detail', [PenjabController::class, 'layananDetail'])->name('penjab.layanan.detail');
});

Route::get('/', function () {
    return view('welcome');
});

Route::view('/', 'pages.landing')->name('landing');
