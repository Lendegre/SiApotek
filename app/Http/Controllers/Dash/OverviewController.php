<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function showOverview()
    {
        $data = [
            'title'     => 'Overview',
            'id_page'   => 1,
        ];

        return view('dash.overview', $data);
    }
}
