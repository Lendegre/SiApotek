<?php

use App\Models\Barangmasuk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController as Auth;
use App\Http\Controllers\Dash\UserController as User;
use App\Http\Controllers\Dash\ReportController as Report;
use App\Http\Controllers\Dash\AnalyticsController as Analytics;
use App\Http\Controllers\Dash\MasterDataController as MasterData;
use App\Http\Controllers\Dash\PurchaseSalesController as PurchaseSales;

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

        Route::middleware('role:admin,apoteker')->group(function () {
            Route::prefix('/purchase-management')->group(function () {
                Route::get('/', [PurchaseSales::class, 'showPurchaseManagement'])->name('purchase-management');
                Route::get('/data-surat', [PurchaseSales::class, 'showDataSurat'])->name('data-surat');
                Route::get('/purchase-product/{no_surat}', [PurchaseSales::class, 'showPurchaseProduct'])->name('purchase-product');
                Route::post('/create-purchase', [PurchaseSales::class, 'createPurchase'])->name('create-purchase');
                Route::post('/create-purchase-product', [PurchaseSales::class, 'createPurchaseProduct'])->name('create-purchase-product');
                Route::post('/delete-purchase-product/{purchase_product_id}', [PurchaseSales::class, 'deletePurchaseProduct'])->name('delete-purchase-product');
                Route::post('/update-purchase-product/{purchase_product_id}', [PurchaseSales::class, 'updatePurchaseProduct'])->name('update-purchase-product');
            });

            Route::prefix('/sales-management')->group(function () {
                Route::get('/', [PurchaseSales::class, 'showSalesManagement'])->name('sales-management');
                Route::get('/order-product/{customer_id}', [PurchaseSales::class, 'showOrderProduct'])->name('order-product');
                Route::post('/create-order', [PurchaseSales::class, 'createOrder'])->name('create-order');
                Route::post('/create-order-item', [PurchaseSales::class, 'createOrderItem'])->name('create-order-item');
                Route::post('/delete-order-item/{order_id}', [PurchaseSales::class, 'deleteOrderItem'])->name('delete-order-item');
                Route::post('/update-order-item/{order_id}', [PurchaseSales::class, 'updateOrderItem'])->name('update-order-item');
                Route::post('/finish/{customer_id}', [PurchaseSales::class, 'finish'])->name('finish');
            });

            Route::prefix('/faktur-management')->group(function () {
                Route::get('/', [PurchaseSales::class, 'showDataFaktur'])->name('data-faktur');
                // Route::get('/barangmasuk-faktur/{no_surat}', [PurchaseSales::class, 'showBarangMasuk'])->name('barangmasuk_faktur');
                Route::get('/faktur/{no_surat}', [PurchaseSales::class, 'showFakturProduct'])->name('faktur-product');
                Route::post('/create_faktur', [PurchaseSales::class, 'createFaktur'])->name('create_faktur');
                Route::post('/create-faktur-product', [PurchaseSales::class, 'createFakturProduct'])->name('create-faktur-product');
                Route::post('/update-faktur-product/{purchase_id}', [PurchaseSales::class, 'updateFaktur'])->name('update-faktur-product');
                Route::post('/delete-faktur/{purchase_id}', [PurchaseSales::class, 'deleteFaktur'])->name('delete-faktur');
                Route::get('/detail-faktur/{purchase_id}', [PurchaseSales::class, 'showDetailFaktur'])->name('detail-faktur');
                // Route::post('/update-item/{barang_id}', [MasterData::class, 'updateItem'])->name('update-item');
                // Route::get('/show-data-faktur', [PurchaseSales::class, 'showDataFaktur'])->name('show-data-faktur');
            });
        });

        Route::post('/surat-resep/{customer_id}', [PurchaseSales::class, 'previewPDFResep'])->name('surat-resep');
        Route::post('/surat-nonresep/{customer_id}', [PurchaseSales::class, 'previewPDFNonResep'])->name('surat-nonresep');
        Route::post('/surat-pesanan/{purchase_id}', [PurchaseSales::class, 'previewPDFPesanan'])->name('surat-pesanan');
        Route::get('/detail-order/{customer_id}', [PurchaseSales::class, 'showDetailOrder'])->name('detail-order');
        Route::get('/detail-purchase/{purchase_id}', [PurchaseSales::class, 'showDetailPurchase'])->name('detail-purchase');

        Route::middleware('role:pemilik,apoteker')->group(function () {
            Route::prefix('/purchase-agreement')->group(function () {
                Route::get('/', [PurchaseSales::class, 'showPurchaseAgreement'])->name('purchase-agreement');
                Route::post('/update-status', [PurchaseSales::class, 'updateStatus'])->name('update-status');
            });
        });
    });

    // master-data group
    Route::middleware('role:admin,apoteker')->group(function () {
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
    });

    // reports group
    Route::prefix('/reports')->group(function () {
        Route::prefix('/purchase-report')->group(function () {
            Route::get('/', [Report::class, 'showPurchaseReport'])->name('purchase-report');
            Route::get('/filter-purchase', [Report::class, 'filter'])->name('filter-purchase');
            Route::get('/purchase-pdf', [Report::class, 'pdfPurchaseReport'])->name('purchase-pdf');
            Route::post('/delete-report-purchase/{purchase_id}', [Report::class, 'deleteReportPurchase'])->name('delete-report-purchase');
        });

        Route::prefix('/sales-report')->group(function () {
            Route::get('/', [Report::class, 'showSalesReport'])->name('sales-report');
            Route::get('/cari', [Report::class, 'cari'])->name('cari');
            Route::get('/sales-pdf', [Report::class, 'pdfSalesReport'])->name('sales-pdf');
            Route::post('/delete-report-sales/{customer_id}', [Report::class, 'deleteReportSales'])->name('delete-report-sales');
        });

        Route::prefix('/stock-report')->group(function () {
            Route::get('/', [Report::class, 'showStockReport'])->name('stock-report');
            Route::get('/filter-stok', [Report::class, 'filterStok'])->name('filter-stok');
            Route::get('/stock-pdf', [Report::class, 'pdfStockReport'])->name('stock-pdf');
            Route::get('/showLowStock', [Report::class, 'showLowStock'])->name('stock-low');
            Route::get('/showAlmostExp', [Report::class, 'showAlmostExp'])->name('stock-exp');
        });
    });
});
