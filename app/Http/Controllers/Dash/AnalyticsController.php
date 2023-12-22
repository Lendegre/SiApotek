<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Render view overview
     * 
     * @return View
     */
    protected function showOverview()
    {
        // almost expired
        $today = Carbon::now();
        $expiredDate = $today->copy()->addDays(30);
        $almostExp = DB::table('barang')
            ->whereDate('tanggal_kedaluwarsa', '>=', $today)
            ->whereDate('tanggal_kedaluwarsa', '<=', $expiredDate)->count();

        // low stock
        $lowStock = Barang::with(['bentuk'])->whereColumn('isi', '<=', 'minimal_stok')->count();

        // all stock
        $totalProduct = Barang::count();

        $data = [
            'title'             => 'Halaman Utama',
            'id_page'           => 1,
            'count_supplier'    => Supplier::count(),
            'count_user'        => User::count(),
            'count_product'     => Barang::count(),
            'barang'            => Barang::orderBy('barang_id', 'DESC')->get(),
            'totalProduct'      => $totalProduct,
            'lowStock'          => $lowStock,
            'almostExp'         => $almostExp,
        ];

        return view('dash.analytics.overview', $data);
    }
}
