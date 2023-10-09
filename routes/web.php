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
    Route::prefix('/users')->middleware('role:pemilik')->group(function () {
        Route::get('/users-management', [User::class, 'showUserManagement'])->name('users-management');
        Route::post('/create-user', [User::class, 'createUser'])->name('create-user');
        Route::post('/update-user/{user_id}', [User::class, 'updateUser'])->name('update-user');
        Route::post('/delete-user/{user_id}', [User::class, 'deleteUser'])->name('delete-user');
    });

    // purchase-sales group
    Route::prefix('/purchase-sales')->group(function () {
        Route::prefix('/purchase-management')->group(function () {
            Route::get('/', [PurchaseSales::class, 'showPurchaseManagement'])->name('purchase-management');
            Route::get('/purchase-product/{no_surat}', [PurchaseSales::class, 'showPurchaseProduct'])->name('purchase-product');
            Route::post('/create-purchase', [PurchaseSales::class, 'createPurchase'])->name('create-purchase');
            Route::post('/create-purchase-product', [PurchaseSales::class, 'createPurchaseProduct'])->name('create-purchase-product');
            Route::post('/delete-purchase-product/{purchase_product_id}', [PurchaseSales::class, 'deletePurchaseProduct'])->name('delete-purchase-product');
            Route::post('/update-purchase-product/{purchase_product_id}', [PurchaseSales::class, 'updatePurchaseProduct'])->name('update-purchase-product');
            Route::get('/detail-purchase/{purchase_id}', [PurchaseSales::class, 'showDetailPurchase'])->name('detail-purchase');
        });


        Route::middleware('role:pemilik,apoteker')->group(function () {
            Route::get('/purchase-agreement', [PurchaseSales::class, 'showPurchaseAgreement'])->name('purchase-agreement');
        });
        Route::get('/sales-management', [PurchaseSales::class, 'showSalesManagement'])->name('sales-management');
    });

    // master-data group
    Route::prefix('/master-data')->group(function () {
        Route::prefix('/barang')->group(function () {
            Route::get('/', [MasterData::class, 'showDataBarang'])->name('barang');
            Route::get('/add-items/{countData}', [MasterData::class, 'showAddItem'])->name('add-items');
            Route::post('/count-amount-request', [MasterData::class, 'countAmountRequest'])->name('count-amount-request');
            Route::post('/create-items', [MasterData::class, 'createItems'])->name('create-items');
            Route::post('/delete-item/{barang_id}', [MasterData::class, 'deleteItem'])->name('delete-item');
            Route::post('/update-item/{barang_id}', [MasterData::class, 'updateItem'])->name('update-item');
        });

        // supplier group
        Route::prefix('/suplier')->group(function () {
            Route::get('/', [MasterData::class, 'showDataSupplier'])->name('supplier');
            Route::post('/create-supplier', [MasterData::class, 'createSupplier'])->name('create-supplier');
            Route::post('/update-supplier/{supplier_id}', [MasterData::class, 'updateSupplier'])->name('update-supplier');
            Route::post('/delete-supplier/{supplier_id}', [MasterData::class, 'deleteSupplier'])->name('delete-supplier');
        });

        // kategori group
        Route::prefix('/kategori')->group(function () {
            Route::get('/', [MasterData::class, 'showDataKategori'])->name('kategori');
            Route::post('/create-kategori', [MasterData::class, 'createKategori'])->name('create-kategori');
            Route::post('/update-kategori/{kategori_id}', [MasterData::class, 'updateKategori'])->name('update-kategori');
            Route::post('/delete-kategori/{kategori_id}', [MasterData::class, 'deleteKategori'])->name('delete-kategori');
        });

        // bentuk persediaan group
        Route::prefix('/bentuk')->group(function () {
            Route::get('/', [MasterData::class, 'showDataBentuk'])->name('bentuk');
            Route::post('/create-bentuk', [MasterData::class, 'createBentuk'])->name('create-bentuk');
            Route::post('/update-bentuk/{bentuk_id}', [MasterData::class, 'updateBentuk'])->name('update-bentuk');
            Route::post('/delete-bentuk/{bentuk_id}', [MasterData::class, 'deleteBentuk'])->name('delete-bentuk');
        });

        // satuan group
        Route::prefix('/satuan')->group(function () {
            Route::get('/', [MasterData::class, 'showDataSatuan'])->name('satuan');
            Route::post('/create-satuan', [MasterData::class, 'createSatuan'])->name('create-satuan');
            Route::post('/update-satuan/{satuan_id}', [MasterData::class, 'updateSatuan'])->name('update-satuan');
            Route::post('/delete-satuan/{satuan_id}', [MasterData::class, 'deleteSatuan'])->name('delete-satuan');
        });

        // jenis golongan group
        Route::prefix('golongan')->group(function () {
            Route::get('/', [MasterData::class, 'showDataGolongan'])->name('golongan');
            Route::post('/create-golongan', [MasterData::class, 'createGolongan'])->name('create-golongan');
            Route::post('/update-golongan/{golongan_id}', [MasterData::class, 'updateGolongan'])->name('update-golongan');
            Route::post('/delete-golongan/{golongan_id}', [MasterData::class, 'deleteGolongan'])->name('delete-golongan');
        });
    });

    // reports group
    Route::prefix('/reports')->group(function () {
        Route::prefix('/purchase-report')->group(function () {
            Route::get('/', [Report::class, 'showPurchaseReport'])->name('purchase-report');
            Route::post('/delete-report-purchase/{purchase_id}', [Report::class, 'deleteReportPurchase'])->name('delete-report-purchase');
        });

        Route::get('/sales-report', [Report::class, 'showSalesReport'])->name('sales-report');
        Route::get('/stock-report', [Report::class, 'showStockReport'])->name('stock-report');
    });
});
