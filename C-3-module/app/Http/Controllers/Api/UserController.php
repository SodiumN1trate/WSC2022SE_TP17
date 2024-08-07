<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Game;
use App\Models\GameScore;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * Show user
     *
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return new UserResource($user);
    }

    /*
     * Save score
     *
     */
    public function savescore(Request $request, $slug)
    {
        $validated = $request->validate([
            'score' => 'required',
        ]);

        $game = Game::where('slug', $slug)->firstOrFail();
        GameScore::create([
            'score' => $validated['score'],
            'user_id' => auth()->user()->id,
            'version_id' => $game->versions()->latest()->first()->id,
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }
}
