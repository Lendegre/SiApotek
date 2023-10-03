<?php

use App\Http\Controllers\Auth\AuthController as Auth;
use App\Http\Controllers\Dash\AnalyticsController as Analytics;
use App\Http\Controllers\Dash\MasterDataController as MasterData;
use App\Http\Controllers\Dash\PurchaseSalesController as PurchaseSales;
use App\Http\Controllers\Dash\ReportController as Report;
use App\Http\Controllers\Dash\UserController as User;
use Illuminate\Support\Facades\Route;

Route::get('/', [Auth::class, 'showLogin'])->name('login');
Route::post('/handleLogin', [Auth::class, 'handleLogin'])->name('handleLogin');
Route::post('/handleLogout', [Auth::class, 'handleLogout'])->name('handleLogout');

// dashboard page
Route::middleware('auth')->group(function () {
    // analytics group
    Route::prefix('/analytics')->group(function () {
        Route::get('/overview', [Analytics::class, 'showOverview'])->name('overview');
    });

    // users group
    Route::prefix('/users')->group(function () {
        Route::get('/users-management', [User::class, 'showUserManagement'])->name('users-management');
        Route::post('/create-user', [User::class, 'createUser'])->name('create-user');
        Route::post('/update-user/{user_id}', [User::class, 'updateUser'])->name('update-user');
        Route::post('/delete-user/{user_id}', [User::class, 'deleteUser'])->name('delete-user');
    });

    // purchase-sales group
    Route::prefix('/purchase-sales')->group(function () {
        Route::get('/purchase-management', [PurchaseSales::class, 'showPurchaseManagement'])->name('purchase-management');
        Route::get('/sales-management', [PurchaseSales::class, 'showSalesManagement'])->name('sales-management');
    });

    // master-data group
    Route::prefix('/master-data')->group(function () {
        Route::get('/barang', [MasterData::class, 'showDataBarang'])->name('barang');

        // supplier group
        Route::prefix('/suplier')->group(function () {
            Route::get('/', [MasterData::class, 'showDataSupplier'])->name('supplier');
            Route::post('/create-supplier', [MasterData::class, 'createSupplier'])->name('create-supplier');
            Route::post('/update-supplier/{supplier_id}', [MasterData::class, 'updateSupplier'])->name('update-supplier');
            Route::post('/delete-supplier/{supplier_id}', [MasterData::class, 'deleteSupplier'])->name('delete-supplier');
        });

        // kategori groups
        Route::prefix('/kategori')->group(function () {
            Route::get('/', [MasterData::class, 'showDataKategori'])->name('kategori');
            Route::post('/create-supplier', [MasterData::class, 'createKategori'])->name('create-kategori');
            Route::post('/update-kategori/{kategori_id}', [MasterData::class, 'updateKategori'])->name('update-kategori');
            Route::post('/delete-kategori/{kategori_id}', [MasterData::class, 'deleteKategori'])->name('delete-kategori');
        });

        Route::get('/bentuk', [MasterData::class, 'showDataBentuk'])->name('bentuk');
        Route::get('/satuan', [MasterData::class, 'showDataSatuan'])->name('satuan');
        Route::get('/golongan', [MasterData::class, 'showDataGolongan'])->name('golongan');
    });

    // reports group
    Route::prefix('/reports')->group(function () {
        Route::get('/purchase-report', [Report::class, 'showPurchaseReport'])->name('purchase-report');
        Route::get('/sales-report', [Report::class, 'showSalesReport'])->name('sales-report');
        Route::get('/stock-report', [Report::class, 'showStockReport'])->name('stock-report');
    });
});
