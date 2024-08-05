<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /*
     * This endpoint creates a new user and returns a session token.
     *
     */
    public function signUp(Request $request)
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
     * This checks the username and password against all known users. If found, a session token is returned.
     *
     */
    public function signIn(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|min:4|max:60',
            'password' => 'required|min:8|max:65536',
        ]);

        if(Auth::attempt($validated)) {
            return response()->json([
                'status' => 'success',
                'token' => auth()->user()->createToken('login')->plainTextToken,
            ]);
        }

        return response()->json([
            'status' => 'invalid',
            'message' => 'Wrong username or password',
        ], 401);
    }

    /*
     * Deletes the current session token.
     *
     */
    public function signOut()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
