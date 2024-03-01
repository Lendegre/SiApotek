<?php

namespace App\Http\Controllers\Dash;

use App\Models\Order;
use App\Models\Barang;
use App\Models\Faktur;
use App\Models\Satuan;
use App\Models\Customer;
use App\Models\Golongan;
use App\Models\Purchase;
use App\Models\Supplier;  
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PurchaseProduct;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
// use Illuminate\Validation\Rule;



// use Illuminate\Database\QueryException;

class PurchaseSalesController extends Controller
{
    protected $id_page, $model, $getItemByGroup;

    public function __construct()
    {
        $this->id_page = [9, 14, 10, 16];
        $this->model = [
            Supplier::all(),
            Golongan::all(),
            Satuan::all(),
            Faktur::all(),
        ];
        $this->getItemByGroup = MasterDataController::getItemsByGroup();
    }

    /**
     * Render view purchase management
     * 
     * @return View
     */

    protected function showDataSurat()
    {

        $data = [
            'title' => 'Surat Pemesanan Barang',
            'id_page' => 16,
            'purchase_reports' => Purchase::all(),

        ];

        return view('dash.reports.data-surat', $data);
    }


    protected function showPurchaseManagement()
    {
        if (auth()->user()->role == 'admin') {
            $golongan = Golongan::where('jenis_golongan', '!=', 'Narkotika')->where('jenis_golongan', '!=', 'Psikotropika')->get();
        } else {
            $golongan = Golongan::all();
        }

        $data = [
            'title'             => 'Pembelian',
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
        // Ambil data yang sudah disimpan
         $data = Purchase::latest()->first();

        return redirect()->route('purchase-product', $request->input('no_surat'))->withInput()->with('success', 'Data Supplier Tujuan Berhasil Di Simpan')->with('data', $data);
    }

    /**
     * Render view to purchase a product
     *
     * @param $item
     * @param $no_surat
     * @return View
     */
    protected function showPurchaseProduct($no_surat)
    {
        $purchase = Purchase::where('no_surat', $no_surat)->first();
        $barang = Barang::where('supplier_id', $purchase->supplier_id)->whereColumn('stok', '<=', 'minimal_stok')->get();
        // var_dump($barang);
        // exit();
        
        $data = [
            'title'         => 'Pembelian Barang',
            'id_page'       => null,
            'purchase'      => $purchase,
            'barang'        => $barang,
            'products'      => PurchaseProduct::where('purchase_id', $purchase->purchase_id)->get(),
        ];

        return view('dash.purchase-sales.elements.purchase_product', $data);
    }

    /**
     * Logic to create a purchase product
     *
     * @param Request $request
     * @return View
     */
    protected function createPurchaseProduct(Request $request)
    { 
        $barang = PurchaseProduct::where('purchase_id', $request->input('purchase_id'))->where('barang_id', $request->input('barang_id'))->first();

        if (!$barang) {
        if ($request->has('tambahPesanan')) {
            DB::table('purchase_product')->insert([
                'barang_id'     => $request->input('barang_id'),
                'purchase_id'   => $request->input('purchase_id'),
                'satuan_beli'   => $request->input('satuan_beli'),
                'jumlah'        => $request->input('jumlah'),
                'isi'           => $request->input('isi'),
                'bentuk_id'     => $request->input('bentuk_id'),
                'zat'           => $request->input('zat'),
            ]);

            return back()->with('success', 'Success menambahkan barang');    
        }

    }
    return back()->with('error', 'Barang Sudah Ada');
         // Handle other cases if needed
    //  return back()->with('error', 'Gagal menambahkan barang');
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

        return back()->with('info', 'Barang berhasil dihapus!');
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
            'zat'       => $request->input('zat'),
        ]);

        return back()->with('info', 'Barang berhasil diupdate!');
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
     * preview surat pesanan
     * 
     * @param int $purchase_id
     * @return View
     */
    protected function previewPDFPesanan($purchase_id)
    {
        $purchase = Purchase::find($purchase_id);
        $data = [
            'purchase'  => $purchase,
            'products'   => PurchaseProduct::where('purchase_id', $purchase_id)->get(),
        ];

        $pdf = Pdf::loadView('pdf.surat-pesanan', $data);

        return $pdf->stream($purchase->no_surat . '.pdf');
    }

    /**
     * Render view purchase agreement
     * 
     * @return View
     */
    protected function showPurchaseAgreement()
    {
        $data = [
            'title'     => 'Persetujuan Surat',
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
            'keterangan'    => $request->input('keterangan'),
        ]);

        return back()->with('success', 'Status pembelian telah diupdate!');
    }

    /**
     * Render view sales management
     * 
     * @return View
     */
    protected function showSalesManagement()
    {
        $data = [
            'title'     => 'Penjualan',
            'id_page'   => $this->id_page[2],
            'golongan'  => $this->model[1],
        ];

        return view('dash.purchase-sales.sales_management', $data);
    }

    /**
     * Logic to create order
     * 
     * @param Request
     * @return View
     */
    protected function createOrder(Request $request)
    {
        $customer = new Customer();
        $customer->nama =$request->input('nama');
        $customer->jenis_obat = $request->input('jenis_obat');
        $customer->golongan_id = $request->input('golongan_id');

        $customer->save();

        return redirect()->route('order-product', $customer->customer_id)->with('success', 'Success Menambahkan Data Pelanggan');
    }

    /**
     * Render view order product
     * 
     * @param int $customer_id
     * @return View
     */
    protected function showOrderProduct($customer_id)
    {
        $customer = Customer::find($customer_id);
        $data = [
            'title'     => 'Penjualan Barang',
            'id_page'   => null,
            'customer'  => $customer,
            'barang'    => $this->getItemByGroup->where('stok', '>', 0),
            'products'  => Order::where('customer_id', $customer_id)->get(),
        ];

        // var_dump($barang);
        // exit();

        return view('dash.purchase-sales.elements.sales_product', $data);
    }

    /**
     * Logic to create order item
     * 
     * @param Request
     * @return View
     */
    protected function createOrderItem(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $barang = Order::where('customer_id', $request->input('customer_id'))->where('barang_id', $request->input('barang_id'))->first();
        $barangLimit = Barang::where('barang_id', $request->input('barang_id'))->first();
        // $barang_count = Order::count() + 1;

        if (!$barang) {
            if ($barangLimit->stok >= $request->input('stok')) {
                DB::table('orders')->insert([
                    'no_order'      => 'INV-' . date('Ymd', strtotime('now')).$request->input('customer_id'),
                    'barang_id'     => $request->input('barang_id'),
                    'stok'          => $request->input('stok'),
                    'customer_id'   => $request->input('customer_id'),
                    'harga'         => $request->input('stok') * $barangLimit->harga_jual,
                    'tanggal'       => $request->input('tanggal'),
                ]);

                return back()->with('success', 'Berhasil Menambahkan Barang');
            }

            return back()->with('error', 'Stok Tidak Mencukupi!');
        }
        return back()->with('error', 'Barang Sudah Ada');
    }

    /**
     * Logic to delete order item product
     * 
     * @param int $order_id
     * @return RedirectResponse
     */
    protected function deleteOrderItem($order_id)
    {
        DB::table('orders')->where('order_id', $order_id)->delete();

        return back()->with('info', 'Barang pilihan telah dihapus');
    }

    /**
     * Logic to update order item product
     * 
     * @param Request | @param int $order_id
     * @return RedirectResponse
     */
    protected function updateOrderItem(Request $request, $order_id)
    {
        $barangLimit = Barang::where('barang_id', $request->input('barang_id'))->first();
        
        if($barangLimit->stok >= $request->input('stok')) {
            DB::table('orders')->where('order_id', $order_id)->update([
                'stok'       => $request->input('stok'),
                'harga'         => $request->input('stok') * $barangLimit->harga_jual,
            ]);
            return back()->with('info', 'Barang pilihan telah diupdate!');
        }

        return back()->with('error', 'Stok melebihi kapasitas stok yang ada.');
    }


    /**
     * Render view detail sales order
     * 
     * @param int $customer_id
     * @return View
     */
    protected function showDetailOrder($customer_id)
    {
        $customer = Customer::find($customer_id);
        $data = [
            'title'         => 'Detail Pemesanan',
            'id_page'       => null,
            'products'      => Order::where('customer_id', $customer_id)->get(),
            'customer'      => $customer,
            'total_harga'   => Order::where('customer_id', $customer_id)->sum('harga'),
        ];

        return view('dash.purchase-sales.elements.detail_sales', $data);
    }

    /**
     * Render view detail sales order
     * 
     * @param Request
     * @return View
     */
    protected function finish(Request $request, $customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();
        $total_harga = Order::where('customer_id', $customer_id)->sum('harga');
        $customer->update(['status' => 'Dibayar', 'total_harga' => $total_harga]);

        $orders = Order::where('customer_id', $customer_id)->get();

        foreach ($orders as $order) {
            $barang = Barang::where('barang_id', $order->barang_id)->first();
            if ($barang) {
                $stok = $barang->stok - $request->input("stok$order->order_id");
                $barang->update(['stok' => $stok]);
            }
        }

        return redirect()->route('sales-report')->with('success', 'Sukses Melakukan pembayaran');
    }

    /**
     * preview surat resep
     * 
     * @param int $customer_id
     * @return View
     */
    protected function previewPDFResep($customer_id)
    {
        $customer = Customer::find($customer_id);
        $data = [
            'customer'  => $customer,
            'orders'   => Order::where('customer_id', $customer_id)->get(),
            'title' => Order::where('customer_id', $customer_id)->select('no_order')->first(),
            'total_harga'   => Order::where('customer_id', $customer_id)->sum('harga'),
        ];

        $pdf = Pdf::loadView('pdf.surat-resep', $data);

        return $pdf->stream($customer->no_order . '.pdf');
        
    }

    /**
     * preview surat non resep
     * 
     * @param int $customer_id
     * @return View
     */
    protected function previewPDFNonResep($customer_id)
    {
        $customer = Customer::find($customer_id);
        $data = [
            'customer'  => $customer,
            'orders'   => Order::where('customer_id', $customer_id)->get(),
            'title' => Order::where('customer_id', $customer_id)->select('no_order')->first(),
            'total_harga'   => Order::where('customer_id', $customer_id)->sum('harga'),
        ];

        $pdf = Pdf::loadView('pdf.surat-nonresep', $data);

        return $pdf->stream($customer->no_surat . '.pdf');
    }

    public function showFakturManagement()
    {
            $no_surat = Purchase::where('status', 'Diterima')->get();
            $faktur = Faktur::groupBy('no_faktur')->get();

 
        $data = [
            'title'             => 'Data Faktur',
            'id_page'           => 15,
            'no_surat'          => $no_surat,
            'faktur'            =>$faktur,
        ];
        return view('dash.purchase-sales.faktur_managament', $data);
    }


    protected function showFakturProduct($purchase_id)
    {
        $purchase = Purchase::where('purchase_id', $purchase_id)->first();
        // return $purchase;

        $bm = PurchaseProduct::where('purchase_id', $purchase_id)->get();
        

        $data = [
            'title'         => 'Faktur Produk',
            'id_page'       => 15,
            'purchase'      => $purchase,
            'bm'            => $bm,
            // 'no_surat'      => $no_surat,
            // 'products'      => PurchaseProduct::where('purchase_id', $purchase->purchase_id)->get(),
        ];

        return view('dash.purchase-sales.elements.faktur', $data);
    }

    /**
     * Logic to create a purchase product
     *
     * @param Request $request
     * @return View
     */
    protected function createFakturProduct(Request $request)
    {     
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // $image = $request->file('image');
        // $imageName = time().'.'.$image->getClientOriginalExtension();
        // $image->move(public_path('images'), $imageName);
        $images = $request->file('image');
        $image_ekstensi = $images->extension();
        $image_nama = date('ymdhis'). "." . $image_ekstensi;
        $images->move(public_path('faktur_upload'), $image_nama);
        

        $items = count($request->barang_id);
        for ($x = 0; $x<$items; $x++){
           
            $isi_purchase[$x] = PurchaseProduct::where('purchase_id', $request->purchase_id)->value('isi');
            $barang_purchase[$x] = PurchaseProduct::where('purchase_id', $request->purchase_id)->get();
     
            $barang_id = $barang_purchase[0][$x]->barang_id;


            DB::table('faktur')->insert([
                'purchase_id'           => $request->purchase_id,
                'no_faktur'             => $request->no_faktur,
                'image'                 => $image_nama,
                'barang_id'             => $barang_purchase[0][$x]->barang_id,
                'sbayar'                => $request->sbayar,
                'jumlah_trm'            => $request->jumlah_trm[$x],
                'h_beli'                => $request->h_beli[$x],
                'tgl_trm'               => $request->tgl_trm,
                'tgl_tempo'             => $request->tgl_tempo,
                'total'                 => $request->total[$x],
                'g_total'               => $request->g_total,
            ]);

            $barang = Barang::find($barang_id);

            if($barang) {
                $barang->stok = $barang->stok + ($barang->isi * $request->jumlah_trm[$x]);
                $barang->save();
            }
        }

        // Hitung total keseluruhan
        $g_total = 0;

        // Inisialisasi array untuk total masing-masing barang
        $barangTotals = [];

        return redirect('/purchase-sales/faktur-management/')->with('success', 'Berhasil menyimpan data pembelian'); 
    }

    public function updateFaktur(Request $request, $purchase_id)
    {
            DB::table('faktur')->where('purchase_id', $purchase_id)->update([
                'no_faktur' => $request->input('no_faktur'),
                'tgl_trm'   => $request->input('tgl_trm'),
                'tgl_tempo' => $request->input('tgl_tempo'),
                'sbayar'    => $request->input('sbayar'),
            ]);

        return back()->with('info', 'Item has been updated');
    }

    protected function deleteFaktur($no_faktur)
    {
        $data = faktur::where('no_faktur', $no_faktur)->first();
        File::delete(public_path('faktur_upload'). '/' . $data->image);

        DB::table('faktur')->where('no_faktur', $no_faktur)->delete();
        // DB::table('fakturs')->where('purchase_id', $purchase_id)->delete();

        return back()->with('info', 'Faktur berhasil dihapus');
    }

    protected function showDetailFaktur($purchase_id)
    {
        // $faktur = Barangmasuk::find($purchase_id);
        $barang_msk = Faktur::where('purchase_id', $purchase_id)->get();

        // var_dump($barang_msk);
        // exit();
        
        $data = [
            'title'     => 'Detail Faktur : ' . $barang_msk[0]->no_faktur,
            'id_page'   => null,
            'products'  => PurchaseProduct::where('purchase_id', $purchase_id)->get(),
            'barang_msk'    => $barang_msk,
            // 'purchase'  => $purchase
        ];

        // var_dump($barang_msk);
        // exit();


        return view('dash.purchase-sales.elements.detail_faktur', $data);
    }

    public function showEditFaktur($no_faktur)
    {
        $faktur = Faktur::where('no_faktur', $no_faktur)->first();
        $barang_faktur = PurchaseProduct::where('purchase_id', $faktur->purchase_id)->get();

        $data = [
            'title'         => 'Edit Faktur ' . $no_faktur,
            'id_page'       => null,
            'barang_faktur' => $barang_faktur,
            'faktur'        => $faktur
        ];

        return view('dash.purchase-sales.elements.edit_faktur', $data);
    }

}
