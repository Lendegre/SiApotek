<?php

namespace App\Http\Controllers\Dash;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Barang;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AnalyticsController extends Controller
{
    /**
     * Render view overview
     * 
     * @return View
     */
    protected function showOverview(Request $request)
    {
        $harga = Order::select(DB::raw("CAST(SUM(harga) as int) as harga"))
        ->groupBy(DB::raw("Month(tanggal)"))
        ->pluck('harga');

        $bulan = Order::select(DB::raw("MONTHNAME(tanggal) as bulan"))
        ->groupBy(DB::raw("MONTHNAME(tanggal)"))
        ->pluck('bulan');


        // almost expired
        $today = Carbon::now();
        $expiredDate = $today->copy()->addDays(30);
        $almostExp = DB::table('barang')
            ->whereDate('tanggal_kedaluwarsa', '>=', $today)
            ->whereDate('tanggal_kedaluwarsa', '<=', $expiredDate)->count();

        // low stock
        $lowStock = Barang::with(['bentuk'])->whereColumn('stok', '<=', 'minimal_stok')->count();

        // all product
        $totalProduct = Barang::count();

        //all stok
        $totalStok = Barang::sum('stok');

        //persetujuan surat pesanan
        $nomorSuratPending = Purchase::where('status', 'Pending')->get();
        $count_pending = $nomorSuratPending->count();

        //surat pesanan yang ditolak
        $tolakSurat = Purchase::where('status', 'Ditolak')->get();
        $count_tolak = $tolakSurat->count();

        $data = [
            'title'             => 'Halaman Utama',
            'id_page'           => 1,
            'count_pending'     => $count_pending,
            'count_tolak'       => $count_tolak,
            'count_user'        => User::count(),
            'count_product'     => Barang::count(),
            'barang'            => Barang::orderBy('barang_id', 'DESC')->get(),
            'totalProduct'      => $totalProduct,
            'totalStok'         => $totalStok,
            // 'topSold'           => $topSold,
            'lowStock'          => $lowStock,
            'almostExp'         => $almostExp,
        ];


        return view('dash.analytics.overview', compact('harga', 'bulan'), $data);
    }

    // public function search(Request $request)
    // {   
    //     if($request->has('search')){
    //         $barang_search = Barang::where('nama_barang', 'LIKE', '%'.$request->search.'%')->get();
    //     }else
    //     {
    //         $barang_search = Barang::all();
    //     }

    //     $harga = Order::select(DB::raw("CAST(SUM(harga) as int) as harga"))
    //     ->groupBy(DB::raw("Month(tanggal)"))
    //     ->pluck('harga');

    //     $bulan = Order::select(DB::raw("MONTHNAME(tanggal) as bulan"))
    //     ->groupBy(DB::raw("MONTHNAME(tanggal)"))
    //     ->pluck('bulan');


    //     // almost expired
    //     $today = Carbon::now();
    //     $expiredDate = $today->copy()->addDays(30);
    //     $almostExp = DB::table('barang')
    //         ->whereDate('tanggal_kedaluwarsa', '>=', $today)
    //         ->whereDate('tanggal_kedaluwarsa', '<=', $expiredDate)->count();

    //     // low stock
    //     $lowStock = Barang::with(['bentuk'])->whereColumn('stok', '<=', 'minimal_stok')->count();

    //     // all product
    //     $totalProduct = Barang::count();

    //     //all stok
    //     $totalStok = Barang::sum('stok');

    //     //persetujuan surat pesanan
    //     $nomorSuratPending = Purchase::where('status', 'Pending')->get();
    //     $count_pending = $nomorSuratPending->count();

    //     //surat pesanan yang ditolak
    //     $tolakSurat = Purchase::where('status', 'Ditolak')->get();
    //     $count_tolak = $tolakSurat->count();

    //     $data = [
    //         'title'             => 'Halaman Utama',
    //         'id_page'           => 1,
    //         'count_pending'     => $count_pending,
    //         'count_tolak'       => $count_tolak,
    //         'count_user'        => User::count(),
    //         'count_product'     => Barang::count(),
    //         // 'barang'            => Barang::orderBy('barang_id', 'DESC')->get(),
    //         'totalProduct'      => $totalProduct,
    //         'totalStok'         => $totalStok,
    //         'barang_search'     => $barang_search,
    //         // 'topSold'           => $topSold,
    //         'lowStock'          => $lowStock,
    //         'almostExp'         => $almostExp,
    //     ];


    //     return view('dash.analytics.overview', compact('harga', 'bulan'), $data);
    // }
}
