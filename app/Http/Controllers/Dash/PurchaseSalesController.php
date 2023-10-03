<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseSalesController extends Controller
{
    protected $label, $id_page;

    public function __construct()
    {
        $this->label = 'Management';
        $this->id_page = [9, 10];
    }

    /**
     * Render view purchase management
     * 
     * @return View
     */
    protected function showPurchaseManagement()
    {
        $data = [
            'title'     => 'Purchase ' . $this->label,
            'id_page'   => $this->id_page[0],
        ];

        return view('dash.purchase-sales.purchase_management', $data);
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
            'id_page'   => $this->id_page[1]
        ];

        return view('dash.purchase-sales.sales_management', $data);
    }
}
