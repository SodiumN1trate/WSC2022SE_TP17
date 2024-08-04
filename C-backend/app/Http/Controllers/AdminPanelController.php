<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    /*
     * Get all admin users
     *
     */
    public function adminUsers()
    {
        return view('admin_users')->with([
            'admins' => AdminUser::all(),
        ]);
    }

    /*
     * Get all users
     *
     */
    public function users()
    {

    }
}
