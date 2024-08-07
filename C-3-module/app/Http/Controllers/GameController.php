<?php

namespace App\Http\Controllers;

use App\Models\GameScore;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    /*
     * Games list
     *
     */
    public function index()
    {
        return view('games_list')->with([
            'games' => Game::withTrashed()->get(),
        ]);
    }

    /*
     * Game profile
     *
     */
    public function show($slug)
    {
        $game = Game::where('slug', $slug)->first();

        return view('game_profile')->with([
            'game' => $game,
        ]);
    }

    /*
     * Game delete
     *
     */
    public function delete(Game $game) {
        $game->delete();
        return redirect('/games_list');
    }

    /*
     * Reset highscores for game
     *
     */
    public function reset(Game $game) {
        $game->versions()->get()->map(function ($version) {
            $version->scores()->delete();
        });
        return view('game_profile')->with([
            'game' => $game,
        ]);
    }

    /*
     * Delete single score
     *
     */
    public function deleteSingleScore(GameScore $score) {
        $score->delete();
        return back();
    }

    /*
     * Delete single score
     *
     */
    public function deleteUserScore(User $user) {
        $user->scores()->delete();
        return back();
    }


}
