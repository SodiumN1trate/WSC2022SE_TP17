<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
     * This endpoint creates a new user and returns a session token.
     *
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|min:4|max:60',
            'password' => 'required|min:8|max:65536',
        ]);

        $user = User::create($validated);

        $token = $user->createToken('login')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
        ], 201);
    }

    /*
     * This checks the username and password against all known users. If found, a session token is returned.
     *
     */
    public function signin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|min:4|max:60',
            'password' => 'required|min:8|max:65536',
        ]);

        $user = User::where('username', $validated['username'])->first();

        if(Hash::check($validated['password'], $user->password)) {
            $token = $user->createToken('login')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'token' => $token,
            ]);
        }

        return response()->json([
            'status' => 'invalid',
            'token' => 'Wrong username or password',
        ], 401);
    }

    /*
     * Deletes the current session token.
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
