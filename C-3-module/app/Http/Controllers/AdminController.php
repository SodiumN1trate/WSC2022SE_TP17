<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /*
     * Admin list
     *
     */
    public function index()
    {
        return view('admin_list')->with([
            'admins' => AdminUser::all(),
        ]);
    }
}
