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
     * Get all admin users
     *
     */
    public function adminUsers()
    {
        return view('admin_users')->with([
            'admins' => AdminUser::all(),
        ]);
    }

    /*
     * Get all users
     *
     */
    public function users()
    {
        return view('users')->with([
            'users' => User::all(),
        ]);
    }

    /*
     * Get user profile
     *
     */
    public function profile($username)
    {
        return view('profile')->with([
            'user' => User::where('username', $username)->first(),
        ]);
    }

    /*
     * Block user by id
     *
     */
    public function block(Request $request, $id)
    {
        $validated = $request->validate([
            'block_reason' => 'required',
        ]);

        $user = User::find($id);
        $user->update($validated);
        return view('users')->with([
            'users' => User::all(),
        ]);
    }


    /*
     * Unblock user by id
     *
     */
    public function unblock($id)
    {

        $user = User::find($id);
        $user->update([
            'block_reason' => null,
        ]);
        return view('users')->with([
            'users' => User::all(),
        ]);
    }

    /*
     * Get all games
     *
     */
    public function games()
    {
        return view('games')->with([
            'games' => Game::all(),
        ]);
    }

    /*
     * Get game profile
     *
     */
    public function gameProfile($slug)
    {
        return view('game_profile')->with([
            'game' => Game::where('slug', $slug)->first(),
        ]);
    }

    /*
     * Game delete
     *
     */
    public function gameDelete($id)
    {
        $game = Game::find($id);
        $game->is_deleted = true;
        $game->save();
        return view('games')->with([
            'games' => Game::all(),
        ]);
    }


    /*
     * Game reset
     *
     */
    public function gameReset($id)
    {
        $game = Game::find($id);

        foreach ($game->versions as $version) {
            $version->scores()->delete();
        }
        return view('games')->with([
            'games' => Game::all(),
        ]);
    }

    /*
     * Delete score
     *
     */
    public function scoreDelete($id)
    {
        $score = GameScore::find($id);
        $score->delete();
        return view('games')->with([
            'games' => Game::all(),
        ]);
    }

    /*
     * Player scores delete
     *
     */
    public function playerScoreDelete($id)
    {
        $user = User::find($id);

        $user->scores()->delete();
        return view('games')->with([
            'games' => Game::all(),
        ]);
    }

}

