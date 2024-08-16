<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * Get user by username
     *
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        if(!isset($user)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This user does not exist',
            ], 404);
        }

        return new UserResource($user);

    }
}
