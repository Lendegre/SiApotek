<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Render view user management
     * 
     * @return View
     */
    protected function showUserManagement()
    {
        $data = [
            'title'     => 'User Management',
            'id_page'   => 8
        ];

        return view('dash.users.user_management', $data);
    }
}
