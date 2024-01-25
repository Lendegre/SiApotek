<?php

namespace App\Http\Controllers\Dash;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Barang;
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
    protected function showOverview()
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

        $data = [
            'title'             => 'Halaman Utama',
            'id_page'           => 1,
            'count_supplier'    => Supplier::count(),
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
}
