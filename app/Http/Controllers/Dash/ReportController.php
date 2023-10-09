<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $label, $id_page;

    public function __construct()
    {
        $this->label = 'Report';
        $this->id_page = [11, 12, 13];
    }

    /**
     * Render view purchase report
     * 
     * @return View
     */
    protected function showPurchaseReport()
    {
        $data = [
            'title' => 'Purchase ' . $this->label,
            'id_page' => $this->id_page[0],
            'purchase_reports' => Purchase::all(),
        ];

        return view('dash.reports.purchase_report', $data);
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
    protected function showSalesReport()
    {
        $data = [
            'title' => 'Sales ' . $this->label,
            'id_page' => $this->id_page[1],
        ];

        return view('dash.reports.sales_report', $data);
    }

    /**
     * Render view purchase report
     * 
     * @return View
     */
    protected function showStockReport()
    {
        $data = [
            'title' => 'Stock ' . $this->label,
            'id_page' => $this->id_page[2],
        ];

        return view('dash.reports.stock_report', $data);
    }
}
