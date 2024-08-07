<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * Users list
     *
     */
    public function index()
    {
        return view('users_list')->with([
            'users' => User::all(),
        ]);
    }

    /*
     * User profile
     *
     */
    public function show($username)
    {
        return view('user_profile')->with([
            'user' => User::where('username', $username)->first(),
        ]);
    }

    /*
     * User block
     *
     */
    public function block(Request $request, $id)
    {
        $validated = $request->validate([
            'reason' => 'required',
        ]);
        $user = User::find($id);
        $user->block_reason = $validated['reason'];
        $user->save();
        return view('user_profile')->with([
            'user' => $user,
        ]);
    }

    /*
     * User unblock
     *
     */
    public function unblock($id)
    {
        $user = User::find($id);
        $user->block_reason = null;
        $user->save();
        return view('user_profile')->with([
            'user' => $user,
        ]);
    }
}
