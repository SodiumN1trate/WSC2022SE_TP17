<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\GameScore;
use App\Models\GameVersion;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use ZipArchive;

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
        }  else if($sortBy === 'uploaddate') {
            $pagination = Game::select('games.*')
                ->join('game_versions', 'games.id', '=', 'game_versions.game_id')
                ->groupBy('games.id')
                ->orderByRaw('MAX(game_versions.id) ' . $sortDir)
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
        if(!isset($game)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This game does not exist',
            ], 404);
        }
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
        if(!isset($game)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This game does not exist',
            ], 404);
        }
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
        if(!isset($game)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This game does not exist',
            ], 404);
        }
        $game->delete();

        return response()->json([
            'status' => 'success',
        ], 204);
    }

    /*
     * Upload game version
     *
     */
    public function uploadVersion(Request $request, $slug)
    {
        $validated = $request->validate([
            'token' => 'required',
            'zipfile' => 'required',
        ]);
        $game = Game::where('slug', $slug)->first();
        if(!isset($game)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This game does not exist',
            ], 404);
        }

        $token = PersonalAccessToken::findToken($validated['token'])->latest()->first();
        $user = $token->tokenable;
        if($game->author_id !== $user->id) {
            return response()->json([
                'status' => 'forbidden',
                'message' => 'You are not the game author',
            ], 403);
        }

        $zip = new ZipArchive();
        if($zip->open($validated['zipfile'])) {
            if($zip->getFromName('index.html')) {
                $version = $game->versions()->latest()->first()->number + 1;
                $path = '/games/' . $game->slug . '/' . $version . '/';
                if($zip->extractTo(storage_path() . '/app/public' . $path)) {
                    GameVersion::create([
                        'game_id' => $game->id,
                        'number' => $version,
                        'path' => $path,
                        'version' => now(),
                    ]);
                    if($zip->getFromName('thumbnail.png')) {
                        $game->thumbnail = $path . 'thumbnail.png';
                    } else {
                        $game->thumbnail = null;
                    }
                    $game->save();

                    return response()->json([
                        'status' => 'success',
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'There was extraction error',
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'There is no index.html file in archive',
                ], 400);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'There was an error',
        ], 400);
    }

    /*
     * Serve game files
     *
     */
    public function serveGameFiles($slug, $version)
    {
        $game = Game::where('slug', $slug)->first();
        if(!isset($game)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This game does not exist',
            ], 404);
        }
        return response()->json([
            'url' => config('app.url') . '/storage' . $game->versions()->where('number', $version)->first()->path,
        ]);
    }

    /*
     * Return high scores
     *
     */
    public function getHighscores($slug)
    {
        $game = Game::where('slug', $slug)->first();
        if(!isset($game)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This game does not exist',
            ], 404);
        }

        $version = $game->versions()->latest()->first();

        $scores = $version->scores()->orderBy('score', 'desc')->get()->map(function($score) {
                return [
                    'username' => $score->user->username,
                    'score' => $score->score,
                    'timestamp' => $score->created_at,
                ];
            });
        return response()->json([
            'scores' => $scores,
        ]);
    }

    /*
     * When a user ends a game run, the score can be posted to this endpoint.
     *
     */
    public function saveScore(Request $request, $slug)
    {
        $validated = $request->validate([
            'score' => 'required|integer',
        ]);

        $game = Game::where('slug', $slug)->first();
        if(!isset($game)) {
            return response()->json([
                'status' => 'error',
                'message' => 'This game does not exist',
            ], 404);
        }

        GameScore::create([
            'score' => $validated['score'],
            'game_version_id' => $game->versions()->latest()->first()->id,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
           'status' => 'success',
        ]);
    }
}
