<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Render view overview
     * 
     * @return View
     */
    protected function showOverview()
    {
        $data = [
            'title'     => 'Overview',
            'id_page'   => 1,
        ];

        return view('dash.analytics.overview', $data);
    }
}
