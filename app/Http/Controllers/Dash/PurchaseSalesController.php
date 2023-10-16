<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Bentuk;
use App\Models\Customer;
use App\Models\Golongan;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Satuan;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
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
     * Render view to purchase a product
     *
     * @param $item
     * @param $no_surat
     * @return View
     */
    protected function showPurchaseProduct($no_surat)
    {
        $purchase = Purchase::where('no_surat', $no_surat)->first();
        $data = [
            'title'         => 'Purchase Product',
            'id_page'       => null,
            'purchase'      => $purchase,
            'barang'        => Barang::where('supplier_id', $purchase->supplier_id)->where('golongan_id', $purchase->golongan_id)->get(),
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

        if ($request->has('tambahPesanan')) {

            DB::table('purchase_product')->insert([
                'barang_id'      => $request->input('barang_id'),
                'purchase_id'   => $request->input('purchase_id'),
                'jumlah'        => $request->input('jumlah'),
                'isi'           => $request->input('isi'),
            ]);
            return back()->with('success', 'Success to add the item');
        }

        if ($request->has('getProduct')) {
            if (!$barang) {
                $selectedItem = Barang::with(['satuan', 'bentuk'])->where('barang_id', $request->input('barang_id'))->first();
                return back()->with('dataSelected', $selectedItem)->withInput();
            } else {
                return back()->with('error', 'Item is already in the table');
            }
        }
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
            'isi'       => $request->input('isi'),
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

    /**
     * Logic to create order
     * 
     * @param Request
     * @return View
     */
    protected function createOrder(Request $request)
    {
        $customer = new Customer();
        $customer->nama_customer = $request->input('nama_customer');
        $customer->usia = $request->input('usia');
        $customer->jenis_obat = $request->input('jenis_obat');
        $customer->alamat = $request->input('alamat');

        $customer->save();

        return redirect()->route('order-product', $customer->customer_id)->with('success', 'Success to create order for customer');
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
            'title'     => 'Order product',
            'id_page'   => null,
            'customer'  => $customer,
            'barang'    => Barang::where('isi', '>', 0)->get(),
            'bentuk'    => $this->model[3],
            'products'  => Order::where('customer_id', $customer_id)->get(),
        ];

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
        $barang = Order::where('customer_id', $request->input('customer_id'))->where('barang_id', $request->input('barang_id'))->first();
        $barangLimit = Barang::where('barang_id', $request->input('barang_id'))->first();

        if (!$barang) {
            if ($barangLimit->isi >= $request->input('isi')) {
                DB::table('orders')->insert([
                    'no_order'   => 'AF-' . rand(),
                    'barang_id'      => $request->input('barang_id'),
                    'isi'   => $request->input('isi'),
                    'customer_id' => $request->input('customer_id'),
                    'harga' => $request->input('isi') * $barangLimit->harga_jual
                ]);

                return back()->with('success', 'Success to add order item');
            }

            return back()->with('error', 'Stock is not enough!');
        }

        return back()->with('error', 'Order item is already in the table');
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

        return back()->with('info', 'Item has been deleted');
    }

    /**
     * Logic to update order item product
     * 
     * @param Request | @param int $order_id
     * @return RedirectResponse
     */
    protected function updateOrderItem(Request $request, $order_id)
    {
        DB::table('orders')->where('order_id', $order_id)->update([
            'isi'       => $request->input('isi'),
        ]);

        return back()->with('info', 'Item has been updated');
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
                $stok = $barang->isi - $request->input("isi$order->order_id");
                $barang->update(['isi' => $stok]);
            }
        }

        return redirect()->route('sales-report')->with('success', 'Have successfully completed the payment');
    }

    /**
     * preview surat pesanan
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
        ];

        $pdf = Pdf::loadView('pdf.surat-resep', $data);

        return $pdf->stream($customer->no_surat . '.pdf');
    }
}
