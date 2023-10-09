<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Bentuk;
use App\Models\Golongan;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseSalesController extends Controller
{
    protected $label, $id_page, $model;

    public function __construct()
    {
        $this->label = 'Management';
        $this->id_page = [9, 14, 10];
        $this->model = [
            Supplier::all(),
            Golongan::all(),
            Satuan::all(),
            Bentuk::all(),
        ];
    }

    /**
     * Render view purchase management
     * 
     * @return View
     */
    protected function showPurchaseManagement()
    {
        if (auth()->user()->role == 'admin') {
            $golongan = Golongan::where('jenis_golongan', '!=', 'Narkotika')->where('jenis_golongan', '!=', 'Psikotropika')->get();
        } else {
            $golongan = Golongan::all();
        }

        $data = [
            'title'             => 'Purchase ' . $this->label,
            'id_page'           => $this->id_page[0],
            'purchase_count'    => Purchase::count() + 1,
            'supplier'          => $this->model[0],
            'golongan'          => $golongan,
        ];

        return view('dash.purchase-sales.purchase_management', $data);
    }

    /**
     * Logic to create purchase
     * 
     * @param Request
     * @return View
     */
    protected function createPurchase(Request $request)
    {
        DB::table('purchase')->insert([
            'no_surat'      => $request->input('no_surat'),
            'supplier_id'   => $request->input('supplier_id'),
            'golongan_id'   => $request->input('golongan_id'),
            'tgl_pengajuan' => now(),
        ]);

        return redirect()->route('purchase-product', $request->input('no_surat'))->with('success', 'Success to create purchase data');
    }

    /**
     * Render view purchase product
     * 
     * @return View
     */
    protected function showPurchaseProduct($no_surat)
    {
        $purchase = Purchase::where('no_surat', $no_surat)->first();
        $data = [
            'title'     => 'Purchase Product',
            'id_page'   => null,
            'purchase'  => $purchase,
            'barang'    => Barang::where('supplier_id', $purchase->supplier_id)->where('golongan_id', $purchase->golongan_id)->get(),
            'satuan'    => $this->model[2],
            'bentuk'    => $this->model[3],
            'products'  => PurchaseProduct::where('purchase_id', $purchase->purchase_id)->get(),
        ];

        return view('dash.purchase-sales.elements.purchase_product', $data);
    }

    /**
     * Logic to create purchase
     * 
     * @param Request
     * @return View
     */
    protected function createPurchaseProduct(Request $request)
    {
        $barang = PurchaseProduct::where('barang_id', $request->input('barang_id'))->first();

        if (!$barang) {
            DB::table('purchase_product')->insert([
                'barang_id'      => $request->input('barang_id'),
                'purchase_id'   => $request->input('purchase_id'),
                'jumlah'   => $request->input('jumlah'),
                'isi'   => $request->input('isi'),
                'satuan_id'   => $request->input('satuan_id'),
                'bentuk_id'   => $request->input('bentuk_id'),
            ]);

            return back()->with('success', 'Success to add item');
        }

        return back()->with('error', 'Item is already in the table');
    }

    /**
     * Logic to delete purchase product
     * 
     * @param int $purchase_product_id
     * @return RedirectResponse
     */
    protected function deletePurchaseProduct($purchase_product_id)
    {
        DB::table('purchase_product')->where('purchase_product_id', $purchase_product_id)->delete();

        return back()->with('info', 'Item has been deleted');
    }

    /**
     * Logic to update purchase product
     * 
     * @param Request | @param int $purchase_product_id
     * @return RedirectResponse
     */
    protected function updatePurchaseProduct(Request $request, $purchase_product_id)
    {
        DB::table('purchase_product')->where('purchase_product_id', $purchase_product_id)->update([
            'jumlah'    => $request->input('jumlah'),
            'satuan_id' => $request->input('satuan_id'),
            'isi'       => $request->input('isi'),
            'bentuk_id' => $request->input('bentuk_id'),
        ]);

        return back()->with('info', 'Item has been updated');
    }

    /**
     * Render view detail purchase
     * 
     * @param int $purchase_id
     * @return View
     */
    protected function showDetailPurchase($purchase_id)
    {
        $purchase = Purchase::find($purchase_id);

        $data = [
            'title'     => 'Detail Pemesanan ' . $purchase->no_surat,
            'id_page'   => null,
            'products'  => PurchaseProduct::where('purchase_id', $purchase_id)->get(),
            'purchase'  => $purchase
        ];

        return view('dash.purchase-sales.elements.detail_purchase', $data);
    }

    /**
     * Render view purchase agreement
     * 
     * @return View
     */
    protected function showPurchaseAgreement()
    {
        $data = [
            'title'     => 'Purchase Agreement',
            'id_page'   => $this->id_page[1],
            'purchase_reports' => Purchase::all(),
        ];

        return view('dash.purchase-sales.purchase_agreement', $data);
    }

    /**
     * Logic to update purchase status
     * 
     * @param Request | @param int $purchase_id
     * @return RedirectResponse
     */
    protected function updateStatus(Request $request)
    {
        DB::table('purchase')->where('purchase_id', $request->input('purchase_id'))->update([
            'status'    => $request->input('status'),
        ]);

        return back()->with('success', 'Purchase status has been updated');
    }

    /**
     * Render view sales management
     * 
     * @return View
     */
    protected function showSalesManagement()
    {
        $data = [
            'title'     => 'Sales ' . $this->label,
            'id_page'   => $this->id_page[2]
        ];

        return view('dash.purchase-sales.sales_management', $data);
    }
}
