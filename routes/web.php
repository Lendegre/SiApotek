<?php

use App\Http\Controllers\Auth\AuthController as Auth;
use App\Http\Controllers\Dash\MasterDataController as MasterData;
use App\Http\Controllers\Dash\OverviewController as Overview;
use Illuminate\Support\Facades\Route;

Route::get('/', [Auth::class, 'showLogin'])->name('login');
Route::post('/handleLogin', [Auth::class, 'handleLogin'])->name('handleLogin');
Route::post('/handleLogout', [Auth::class, 'handleLogout'])->name('handleLogout');

// dashboard page
Route::middleware('auth')->group(function () {
    Route::get('/overview', [Overview::class, 'showOverview'])->name('overview');
    Route::prefix('/data')->group(function () {
        Route::get('/barang', [MasterData::class, 'showDataBarang'])->name('barang');
        Route::get('/suplier', [MasterData::class, 'showDataSupplier'])->name('supplier');
        Route::get('/kategori', [MasterData::class, 'showDataKategori'])->name('kategori');
        Route::get('/bentuk', [MasterData::class, 'showDataBentuk'])->name('bentuk');
        Route::get('/satuan', [MasterData::class, 'showDataSatuan'])->name('satuan');
        Route::get('/golongan', [MasterData::class, 'showDataGolongan'])->name('golongan');
    });
});
