<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\GameVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class GameController extends Controller
{
    /*
     * Returns a paginated list of games.
     *
     */
    public function index(Request $request)
    {
        $sorts = [
            'title' => 'title',
            'uploaddate' => 'created_at',
        ];

        if($request->sortBy === 'popular') {
            $pagination = Game::select('games.*', 'COUNT(game_scores.id) as scoreCount')
                ->join('game_versions', 'games.id', '=', 'game_versions.id')
                ->join('game_scores', 'game_versions.id', '=', 'game_scores.game_version_id')
                ->groupBy('games.id')
                ->orderBy('scoreCount',  isset($request->sortDir) ? $request->sortDir : 'ASC')
                ->paginate(isset($request->size) ? $request->size : 10);
        } else if ($request->sortBy === 'uploaddate') {
            $pagination = Game::select('games.*', 'MAX(game_versions.created_at) as latest')
                ->join('game_versions', 'games.id', '=', 'game_versions.id')
                ->groupBy('games.id')
                ->orderByRaw('latest ' . isset($request->sortDir) ? $request->sortDir : 'ASC')
                ->paginate(isset($request->size) ? $request->size : 10);
        } else {
            $pagination = Game::orderBy('title',  isset($request->sortDir) ? $request->sortDir : 'ASC')->paginate(isset($request->size) ? $request->size : 10);
        }

        return $pagination;
    }

    /*
     * Create a game
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
            'author_id' => auth()->user()->id,
            'slug' => $slug,
        ]);

        return response()->json([
            'status' => 'success',
            'slug' => $slug,
        ], 201);
    }

    /*
     * Returns a games details.
     *
     */
    public function show($slug)
    {
        return new GameResource(Game::where('slug', $slug)->first());
    }

    /*
     * Upload game files
     *
     */
    public function upload(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'zipfile' => 'required'
        ]);
        try {
            $zip = new ZipArchive();
            if($zip->open($validated['zipfile'])) {
                if($zip->extractTo(storage_path() . '/app/public/')) {
                    $folderName = explode('.', $validated['zipfile']->getClientOriginalName())[0];
                    $versionsDirectories = Storage::disk('local')->directories('/public/' . $folderName);
                    $versions = [];
                    foreach ($versionsDirectories as $directory) {
                        $versionDirectory = explode('/', $directory)[2];
                        $versions[] = [
                            'versionDirectory' => $versionDirectory,
                            'version' => str_split($versionDirectory)[1],
                        ];
                    }
                    $latestVersion = $versions[count($versions) - 1];
                    GameVersion::create([
                        'game_id' => $game->id,
                        'path' => '/' . $folderName . '/',
                        'version_number' => $latestVersion['version']
                    ]);
                    $game->update([
                        'thumbnail' => '/' . $folderName . '/' . $latestVersion['versionDirectory'] . '/' . 'thumbnail.png',
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'There was an error',
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'New version uploaded successfully!',
        ], 201);
    }

    /*
     * Serve game files
     *
     */
    public function serveFiles($slug, $version)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $version = $game->versions()->where('version_number', $version)->firstOrFail();
        return response()->json([
            'url' => config('app.url') . '/storage' . $version->path
        ]);
    }

    /*
     * Update game
     *
     */
    public function update(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'title' => 'required|min:3|max:60',
            'description' => 'required|max:200',
        ]);
        $game->update($validated);
        return response()->json([
            'status' => 'success',
        ]);
    }

    /*
     * Delete game
     *
     */
    public function delete($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $game->delete();

        return response()->json([], 204);
    }

    /*
     * Returns the highest scores of each player that played any version of the game, sorted by score (descending).
     *
     */

    public function scores($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();

        $scores = $game->versions()->get()->map(function ($version) {
            return $version->scores;
        });

        dd($scores);
    }
}
