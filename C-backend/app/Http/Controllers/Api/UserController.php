<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * Returns the user details.
     *
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return new UserResource($user);
    }
}
