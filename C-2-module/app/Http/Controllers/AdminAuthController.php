<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /*
     * Admin user authentication
     *
     */
    public function login(Request $request)
    {
        $validated =  $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('admins')->attempt($validated)) {
            $admin = AdminUser::where('username', $validated['username'])->first();
            $admin->last_login_at = now();
            $admin->save();
            return redirect('/admin_list');
        }

        return back()->withErrors([
            'message' => 'Incorrect credentials',
        ]);

    }
}
