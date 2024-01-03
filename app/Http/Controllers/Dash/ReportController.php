<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    protected $label, $id_page;

    public function __construct()
    {
        $this->id_page = [11, 12, 13];
    }

    /**
     * Render view purchase report
     * 
     * @return View
     */
    protected function showPurchaseReport(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');

        $barangmasuk = Barangmasuk::all();

        $data = [
            'title' => 'Laporan Pembelian Barang',
            'id_page' => $this->id_page[0],
            'barangmasuk' => $barangmasuk,
            'tanggalAwal'    => $tanggalAwal,
            'tanggalAkhir'    => $tanggalAkhir,
        ];

        return view('dash.reports.purchase_report', $data);
    }

    public function filter(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');

        // Simpan nilai inputan tanggal ke dalam sesi
        $request->session()->put('tanggalAwal', $request->input('tanggalAwal'));
        $request->session()->put('tanggalAkhir', $request->input('tanggalAkhir'));
        
        // Query data dari model berdasarkan tanggal
        $barangmasuk = Barangmasuk::whereBetween('tgl_trm', [$tanggalAwal, $tanggalAkhir])->get();

        // Hitung total pendapatan
        // $income['harga'] = Order::whereBetween('tanggal', [$request->input('tanggalAwal'), $request->input('tanggalAkhir')])
        //     ->sum('harga');

        return view('dash.reports.purchase_report', compact('barangmasuk'),
                    [
                        'title' => 'Laporan Pembelian Barang',
                        'id_page' => $this->id_page[0],
                        'barangmasuk' => $barangmasuk,
                        'tanggalAwal' => session('tanggalAwal'),
                        'tanggalAkhir' => session('tanggalAkhir'),
                    ]);   
    }

    public function pdfPurchaseReport(Request $request)
    {
        $tanggalAwal = $request->tanggalAwal;
        $tanggalAkhir = $request->tanggalAkhir;

        // Ambil data untuk ditampilkan di PDF
        $barangmasuk = Barangmasuk::whereBetween('tgl_trm', [$tanggalAwal, $tanggalAkhir])->get();

        // Hitung total pendapatan
        // Hitung grand total
        $grandTotal = $barangmasuk->sum('total');

        // Tampilkan data ke dalam PDF
        $pdf = PDF::loadView('pdf.report_purchase', [
            'barangmasuk' => $barangmasuk, 
            'grandTotal' =>$grandTotal, 
            'tanggalAwal' =>$tanggalAwal, 
            'tanggalAkhir' =>$tanggalAkhir]);

        // Simpan atau tampilkan PDF sesuai kebutuhan
        return $pdf->stream('Laporan.pdf');
    }    


    /**
     * Logic to delete purchase report
     * 
     * @param int $purchase_id
     * @return RedirectResponse
     */
    protected function deleteReportPurchase($purchase_id)
    {
        DB::table('purchase')->where('purchase_id', $purchase_id)->delete();

        return back()->with('info', 'Purchase report has been deleted');
    }


    /**
     * Render view purchase report
     * 
     * @return View
     */
    protected function showSalesReport(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');

        $data = [
            'title' => 'Laporan Penjualan',
            'id_page' => $this->id_page[1],
            'sales_report' => Order::all(),
            'income'    => Customer::sum('total_harga'),
            'tanggalAwal'    => $tanggalAwal,
            'tanggalAkhir'    => $tanggalAkhir,
        ];

        return view('dash.reports.sales_report', $data);
    }

    public function cari(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');

        // Simpan nilai inputan tanggal ke dalam sesi
        $request->session()->put('tanggalAwal', $request->input('tanggalAwal'));
        $request->session()->put('tanggalAkhir', $request->input('tanggalAkhir'));
        
        // Query data dari model berdasarkan tanggal
        $sales_report = Order::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();

        // Hitung total pendapatan
        $income['harga'] = Order::whereBetween('tanggal', [$request->input('tanggalAwal'), $request->input('tanggalAkhir')])
            ->sum('harga');

        return view('dash.reports.sales_report', compact('sales_report','income'),
                    [
                        'title' => 'Laporan Penjualan',
                        'id_page' => $this->id_page[1],
                        'income' => $income,
                        'tanggalAwal' => session('tanggalAwal'),
                        'tanggalAkhir' => session('tanggalAkhir'),
                    ]);   
    }

    public function pdfSalesReport(Request $request)
    {
        $tanggalAwal = $request->tanggalAwal;
        $tanggalAkhir = $request->tanggalAkhir;

        // Ambil data untuk ditampilkan di PDF
        $sales_report = Order::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();

        // Hitung total pendapatan
        // Hitung grand total
        $grandTotal = $sales_report->sum('harga');

        // Tampilkan data ke dalam PDF
        $pdf = PDF::loadView('pdf.report_sales', [
            'sales_report' => $sales_report, 
            'grandTotal' =>$grandTotal, 
            'tanggalAwal' =>$tanggalAwal, 
            'tanggalAkhir' =>$tanggalAkhir]);

        // Simpan atau tampilkan PDF sesuai kebutuhan
        return $pdf->stream('Laporan.pdf');
    }

    /**
     * Logic to delete purchase report
     * 
     * @param int $purchase_id
     * @return RedirectResponse
     */
    protected function deleteReportSales($customer_id)
    {
        DB::table('customer')->where('customer_id', $customer_id)->delete();

        return back()->with('info', 'Sales report has been deleted');
    }


    /**
     * Render view stock report
     * 
     * @return View
     */
    protected function showStockReport(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');

        $barang = Barang::all();
        $order = Order::all();

        // $barang = DB::table('Barang as t1')
        // ->join('Orders as t2', 't1.Barang_id', '=', 't2.Barang_id')
        // ->select('t1.isi as isi_b', 't2.isi as j_jual', 't1.*', 't2.*')
        // ->get();

        // var_dump($barang);
        // exit();

        $data = [
            'title' => 'Laporan Persediaan',
            'id_page' => $this->id_page[2],
            'sub_page'  => 'stock1',
            'barang'    => $barang,
            'order'    => $order,
            'tanggalAwal'    => $tanggalAwal,
            'tanggalAkhir'    => $tanggalAkhir,
        ];

        // return $barang;

        // var_dump($barang);
        // exit();

        return view('dash.reports.stock_report', $data);
    }

    public function filterStok(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');

        // Simpan nilai inputan tanggal ke dalam sesi
        $request->session()->put('tanggalAwal', $request->input('tanggalAwal'));
        $request->session()->put('tanggalAkhir', $request->input('tanggalAkhir'));
        
        // Query data dari model berdasarkan tanggal
        $barang = Barang::whereBetween('tanggal_masuk', [$tanggalAwal, $tanggalAkhir])->get();

        // Hitung total pendapatan
        // $income['harga'] = Order::whereBetween('tanggal', [$request->input('tanggalAwal'), $request->input('tanggalAkhir')])
        //     ->sum('harga');

        return view('dash.reports.stock_report', compact('barang'),
                    [
                        'title' => 'Laporan Persediaan',
                        'id_page' => $this->id_page[2],
                        'sub_page'  => 'stock1',
                        'barang'    => Barang::all(),
                        'tanggalAwal' => session('tanggalAwal'),
                        'tanggalAkhir' => session('tanggalAkhir'),
                                ]);   
    }

    /**
     * Render view low stock report
     * 
     * @return View
     */
    protected function showLowStock(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');
        $lowStock = Barang::with(['bentuk'])->whereColumn('isi', '<=', 'minimal_stok');

        $infoLowStock = $lowStock->count();

        $data = [
            'title' => 'Barang Hampir Habis',
            'id_page' => $this->id_page[2],
            'sub_page' => 'stock2',
            'barang' => $lowStock->get(),
            'info'  => $infoLowStock,
            'tanggalAwal'    => $tanggalAwal,
            'tanggalAkhir'    => $tanggalAkhir,
        ];

        return view('dash.reports.stock_low', $data);
    }

    /**
     * Render view almost expired stock report
     * 
     * @return View
     */
    protected function showAlmostExp()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = Carbon::now();
        $expiredDate = $today->copy()->addDays(30);
        $almostExp = DB::table('barang')
            ->whereDate('tanggal_kedaluwarsa', '>=', $today)
            ->whereDate('tanggal_kedaluwarsa', '<=', $expiredDate);

        $infoAlmostExp = $almostExp->count();

        $data = [
            'title' => 'Kedaluwarsa',
            'id_page' => $this->id_page[2],
            'sub_page'  => 'stock3',
            'barang'    => $almostExp->get(),
            'info'  => $infoAlmostExp,
        ];

        return view('dash.reports.stock_report', $data);
    }
}
