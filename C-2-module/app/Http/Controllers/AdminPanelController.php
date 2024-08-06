<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\Game;
use App\Models\GameScore;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    /*
     * Return list of admins
     *
     */
    public function adminIndex()
    {
        return view('admins')->with([
            'admins' => AdminUser::all(),
        ]);
    }

    /*
     * Return list of users
     *
     */
    public function usersIndex()
    {
        return view('users')->with([
            'users' => User::all(),
        ]);
    }

    /*
     * Return user profile
     *
     */
    public function userProfile($username)
    {
        return view('user_profile')->with([
            'user' => User::where('username', $username)->first(),
        ]);
    }

    /*
     * Block user
     *
     */
    public function userBlock(Request $request, User $user)
    {
        $validated = $request->validate([
            'reason' => 'required',
        ]);

        $user->block_reason = $validated['reason'];
        $user->save();
        return view('user_profile')->with([
            'user' => $user,
        ]);
    }

    /*
     * Unblock user
     *
     */
    public function userUnblock(User $user)
    {
        $user->block_reason = null;
        $user->save();
        return view('user_profile')->with([
            'user' => $user,
        ]);
    }

    /*
     * Return games list
     *
     */
    public function gamesIndex()
    {
        return view('games')->with([
            'games' => Game::withTrashed()->get(),
        ]);
    }

    /*
      * Return games profile
      *
      */
    public function gameProfile($slug)
    {
        $game = Game::withTrashed()->where('slug', $slug)->first();
        return view('game_profile')->with([
            'game' => $game,
        ]);
    }

    /*
     * Delete game
     *
     */
    public function gameDelete(Game $game)
    {
        $game->delete();
        return view('games')->with([
            'games' => Game::withTrashed()->get(),
        ]);
    }

    /*
     * Reset score for game
     *
     */
    public function gameReset($game)
    {
        $game = Game::withTrashed()->find($game);
        $game->versions()->get()->map(function ($version) {
            $version->scores()->delete();
        });
        return view('game_profile')->with([
            'game' => $game,
        ]);
    }

    /*
     * Reset player score
     *
     *
     */
    public function userReset(User $user)
    {
        $user->scores()->delete();
        return view('games')->with([
            'games' => Game::withTrashed()->get(),
        ]);
    }

    /*
     * Delete score
     *
     *
     */
    public function scoreDelete($score)
    {
        $gameScore = GameScore::find($score);
        $gameScore->delete();
        return view('games')->with([
            'games' => Game::withTrashed()->get(),
        ]);
    }
}
