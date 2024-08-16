<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{
    /*
     * Returns a paginated list of games.
     *
     *
     */
    public function index(Request $request)
    {
        $size =  isset($request->size) ? $request->size : 10;
        $sortBy =  isset($request->sortBy) ? $request->sortBy : 'title';
        $sortDir = isset($request->sortDir) ? $request->sortDir : 'asc';

        if($sortBy === 'popular') {
            $pagination = Game::select('games.*')
                ->join('game_versions', 'games.id', '=', 'game_versions.game_id')
                ->join('game_scores', 'game_versions.id', '=', 'game_scores.version_id')
                ->groupBy('games.id')
                ->orderByRaw('COUNT(game_scores.id) '. $sortDir)
                ->paginate($size);
        } else if($sortBy === 'uploaddate') {
            $pagination = Game::select('games.*')
                ->join('game_versions', 'games.id', '=', 'game_versions.game_id')
                ->groupBy('games.id')
                ->orderByRaw('MAX(game_versions.id) '. $sortDir)
                ->paginate($size);
        } else {
            $pagination = Game::orderBy('title', $sortDir)->paginate($size);
        }

        return response()->json([
            'page' => $pagination->currentPage(),
            'size' => $size,
            'total' => $pagination->total(),
            'content' => GameResource::collection($pagination->items()),
        ]);
    }

    /*
     * Create game
     *
     *
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:60',
            'description' => 'required|max:200',
        ]);

        $slug = str_replace(' ', '-', strtolower($validated['title']));
        if(Game::where('slug', $slug)->first() !== null) {
            return response()->json([
                'status' => 'invalid',
                'slug' => 'Game title already exists',
            ], 400);
        }
        Game::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'slug' => $slug,
            'author_id' => auth()->user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'slug' => $slug,
        ], 201);
    }

    /*
     * show game
     *
     *
     */
    public function show($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        return new GameResource($game);
    }


    /*
    * delete game
     *
     *
     */
    public function delete($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $game->versions()->get()->map(function ($version) {
            $version->scores()->delete();
            $version->delete();
        });
        $game->delete();
        return response()->json([], 204);
    }

    /*
    * delete game
     *
     *
     */
    public function scores($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();

        $versions = $game->versions()->get()->map(function ($version) use ($game) {
            return $version->scores()->orderBy('score', 'asc')->first();
        })->filter();
        $result = [];
        foreach ($versions as $version) {
            $result[] = [
                'username' => $version->user->username,
                'score' => $version->score,
                'timestamp' => $version->created_at,
            ];
        }
        return response()->json([
            'scores' => $result,
        ]);
    }

    /*
     * Serve game files
     *
     */
    public function serve($slug, $version)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $version = $game->versions()->where('number', $version)->firstOrFail();
        return response()->json([
            'url' => config('app.url') . '/storage'. $version->path,
        ]);
    }


    /*
     * Update game
     *
     */
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:60',
            'description' => 'required|max:200',
        ]);

        $game = Game::where('slug', $slug)->firstOrFail();
        $game->update($validated);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
