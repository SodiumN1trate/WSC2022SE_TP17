<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
     * User signin
     *
     */
    public function signin(Request $request)
    {
//        hellobyte1!
        $validated = $request->validate([
            'username' => 'required|min:4|max:60',
            'password' => 'required|min:8|max:65536',
        ]);

        $user = User::where('username', $validated['username'])->first();
        if(isset($user) && Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 'success',
                'token' => $user->createToken('login')->plainTextToken,
            ]);
        }
        return response()->json([
            'status' => 'invalid',
            'message' => 'Wrong username or password',
        ], 401);
    }

    /*
     * User register
     *
     *
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|min:4|max:60',
            'password' => 'required|min:8|max:65536',
        ]);

        $user = User::create($validated);
        return response()->json([
            'status' => 'success',
            'token' => $user->createToken('login')->plainTextToken,
        ], 201);
    }

    /*
     * User signout
     *
     */
    public function signout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
