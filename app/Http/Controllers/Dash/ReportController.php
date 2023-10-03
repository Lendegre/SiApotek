<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        ];

        return view('dash.reports.purchase_report', $data);
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
