<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    /*
     *
     * Handle login for admins
     *
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('admin')->attempt($validated)) {
            $admin = AdminUser::where('username', $validated['username'])->first();
            $admin->last_login_at = now();
            $admin->save();
            return redirect('/admin_users');
        } else {
            dd('nope');
        }

    }
}
