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
     * Handle request to create user data
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

    /**
     * Handle request to delete user data
     * 
     * @return RedirectResponse
     */
    protected function deleteUser($user_id)
    {
        DB::table('users')->where('user_id', $user_id)->delete();

        return back()->with('info', 'User has been deleted');
    }

    /**
     * Hande request to update user data
     * 
     * @param Request
     * @return RedirectResponse
     */
    protected function updateUser(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if ($user->username != $request->input('username')) {
            DB::table('users')->where("user_id", $user_id)->update([
                'username'  => $request->input('username'),
                'password'  => bcrypt('arfafarma23'),
            ]);
            return back()->with('info', 'User has been updated');
        }

        return back();
    }
}
