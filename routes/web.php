<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\wali\waliController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\BiayaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\RekeningController;
use App\Http\Controllers\Admin\WaliMuridController;
use App\Http\Controllers\Wali\WaliProfileController;
use App\Http\Controllers\operator\operatorController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Operator\OperatorProfileController;
use App\Http\Controllers\Operator\OperatorTagihanController;
use App\Http\Controllers\Wali\PembayaranController as WaliPembayaranController;
use App\Http\Controllers\Operator\PembayaranController as OperatorPembayaranController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('home', [AdminController::class, 'home'])->name('home');
    Route::get('kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::get('siswa/get-wali', [SiswaController::class, 'getWali'])->name('siswa.get-wali');

    Route::get('rekening', [RekeningController::class, 'index'])->name('rekening.index');
    Route::get('rekening/create', [RekeningController::class, 'create'])->name('rekening.create');
    Route::post('rekening', [RekeningController::class, 'store'])->name('rekening.store');
    Route::get('rekening/{id}/edit', [RekeningController::class, 'edit'])->name('rekening.edit');
    Route::put('rekening/{id}', [RekeningController::class, 'update'])->name('rekening.update');
    Route::delete('rekening/{id}', [RekeningController::class, 'destroy'])->name('rekening.destroy');

    Route::get('biaya', [BiayaController::class, 'index'])->name('biaya.index');
    Route::get('biaya/create', [BiayaController::class, 'create'])->name('biaya.create');
    Route::post('biaya', [BiayaController::class, 'store'])->name('biaya.store');
    Route::get('biaya/{id}/edit', [BiayaController::class, 'edit'])->name('biaya.edit');
    Route::put('biaya/{id}', [BiayaController::class, 'update'])->name('biaya.update');
    Route::delete('biaya/{id}', [BiayaController::class, 'destroy'])->name('biaya.destroy');

    Route::get('tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
    Route::get('tagihan/create', [TagihanController::class, 'create'])->name('tagihan.create');
    Route::post('tagihan', [TagihanController::class, 'store'])->name('tagihan.store');
    Route::delete('tagihan/{id}', [TagihanController::class, 'destroy'])->name('tagihan.destroy');

    Route::get('/wali', [WaliMuridController::class, 'index'])->name('wali.index');
    Route::get('/wali/create', [WaliMuridController::class, 'create'])->name('wali.create');
    Route::post('/wali', [WaliMuridController::class, 'store'])->name('wali.store');
    Route::get('wali/edit/{id}', [WaliMuridController::class, 'edit'])->name('wali.edit');
    Route::put('wali/{id}', [WaliMuridController::class, 'update'])->name('wali.update');
    Route::post('wali/delete/{id}', [WaliMuridController::class, 'destroy'])->name('wali.destroy');

    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profiles.update');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak-wali', [LaporanController::class, 'cetakWali'])->name('laporan.cetak_wali');
    Route::get('/laporan/cetak-siswa', [LaporanController::class, 'cetakSiswa'])->name('laporan.cetak_siswa');
    Route::get('/laporan/cetak-tagihan', [LaporanController::class, 'cetakTagihan'])->name('laporan.cetak_tagihan');
    Route::get('/laporan/cetak-pembayaran', [LaporanController::class, 'cetakPembayaran'])->name('laporan.cetak_pembayaran');
});

Route::middleware(['auth', 'role:operator'])->prefix('operator')->name('operator.')->group(function () {
    Route::get('/home', [operatorController::class, 'home'])->name('home');

    Route::get('/tagihan', [OperatorTagihanController::class, 'index'])->name('tagihan.index');

    Route::get('/profile', [OperatorProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profile/edit', [OperatorProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profile', [OperatorProfileController::class, 'update'])->name('profiles.update');

    Route::get('/pembayaran', [OperatorPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::patch('/pembayaran/{id}/update-status', [OperatorPembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');
    Route::patch('/tagihan/{id}/update-status', [OperatorTagihanController::class, 'updateStatus'])->name('tagihan.updateStatus');
});

Route::middleware(['auth', 'role:wali'])->prefix('wali')->name('wali.')->group(function () {
    Route::get('home', [waliController::class, 'home'])->name('home');

    Route::get('/pembayaran', [WaliPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create/{tagihan_id}', [WaliPembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [WaliPembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/riwayat', [WaliPembayaranController::class, 'riwayat'])->name('pembayaran.riwayat');
    Route::get('/pembayaran/{id}/invoice', [WaliPembayaranController::class, 'invoice'])->name('pembayaran.invoice');

    Route::get('/profile', [WaliProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profile/edit', [WaliProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profile', [WaliProfileController::class, 'update'])->name('profiles.update');
});
