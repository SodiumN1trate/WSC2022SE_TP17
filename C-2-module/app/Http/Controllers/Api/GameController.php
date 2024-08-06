<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /*
     * Returns a paginated list of games.
     *
     */
    public function index(Request $request)
    {
        $size = isset($request->size) ?  $request->size : 10;
        $sortBy = isset($request->sortBy) ?  $request->sortBy : 'title';
        $sortDir = isset($request->sortDir) ?  $request->sortDir : 'asc';

        if($sortBy === 'popular') {
            $pagination = Game::select('games.*')
                ->join('game_versions', 'games.id', '=', 'game_versions.game_id')
                ->join('game_scores', 'game_versions.id', '=', 'game_scores.game_version_id')
                ->groupBy('games.id')
                ->orderByRaw('COUNT(game_scores.id) ' . $sortDir)
                ->paginate($size);
        } else {
            $pagination = Game::orderBy('title', $sortDir)->paginate($size);
        }

        return response()->json([
           'page' => $pagination->currentPage(),
           'size' => $size,
           'totalElements' => $pagination->total(),
           'content' => GameResource::collection($pagination->items()),
        ]);
    }

    /*
     * Create game
     *
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:60',
            'description' => 'required|max:200',
        ]);
        $title = $validated['title'];
        $validated['author_id'] = auth()->user()->id;
        $validated['slug'] = str_replace(' ', '-', strtolower($title));

        if(Game::where('slug', $validated['slug'])->first() !== null) {
            return response()->json([
                'status' => 'invalid',
                'slug' => 'Game title already exists',
            ], 400);
        }

        Game::create($validated);

        return response()->json([
            'status' => 'success',
            'slug' => $validated['slug'],
        ], 201);
    }

    /*
     * Returns a games details.
     *
     */
    public function show($slug)
    {
        $game = Game::where('slug', $slug)->first();
        $scoreCount = $game->versions()->get()->map(function ($version) {
            return $version->scores()->count();
        })->toArray();
        return response()->json([
            'slug' => $game->slug,
            'title' => $game->title,
            'description' => $game->description,
            'thumbnail' => $game->thumbnail,
            'uploadTimestamp' => $game->created_at,
            'author' => $game->author->username,
            'scoreCount' => array_sum($scoreCount),
            'gamePath' => $game->versions()->latest()->first()->path ?? null,
        ]);
    }

    /*
     * Update game
     *
     *
     */
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:60',
            'description' => 'required|max:200',
        ]);

        $game = Game::where('slug', $slug)->first();
        $game->update($validated);

        return response()->json([
            'status' => 'success',
        ]);
    }

    /*
     * Delete game
     *
     *
     */
    public function delete($slug)
    {
        $game = Game::where('slug', $slug)->first();
        $game->delete();

        return response()->json([
            'status' => 'success',
        ], 204);
    }
}
