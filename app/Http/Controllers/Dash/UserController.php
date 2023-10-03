<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Render view user management
     * 
     * @return View
     */
    protected function showUserManagement()
    {
        $user = auth()->user();
        $data = [
            'title'     => 'User Management',
            'id_page'   => 8,
            'users'     => User::where('username', '!=', $user->username)->get(),
        ];

        return view('dash.users.user_management', $data);
    }

    /**
     * Handle request post to create user data
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function createUser(Request $request)
    {
        DB::table('users')->insert([
            'username'  => $request->input('username'),
            'password'  => bcrypt('arfafarma23'),
        ]);

        return back()->with('success', 'Success to create user');
    }
}
