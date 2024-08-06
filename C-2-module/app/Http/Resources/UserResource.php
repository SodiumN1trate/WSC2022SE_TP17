<?php

namespace App\Http\Resources;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'username' => $this->username,
            'registeredTimestamp' => $this->created_at,
            'authoredGames' => $this->games()->get()->map(function($game)  {
                if(count($game->versions) > 0 || auth()->user()->id === $this->id) {
                    return [
                        'slug' => $game->slug,
                        'title' => $game->title,
                        'description' => $game->description,
                    ];
                }
                return null;
            })->filter(),
            'highscores' => Game::get()->map(function ($game) {
                    $versions = $game->versions()->get()->map(function ($version) {
                        return $version->scores()->where('user_id', $this->id)->orderBy('score', 'desc')->first();
                    })->filter();
                    foreach ($versions as $version) {
                        return [
                            'game' => [
                                'slug' => $game->slug,
                                'title' => $game->title,
                                'description' => $game->description,
                            ],
                            'score' => $version,
                            'created_at' => $version->created_at,
                        ];
                    }
                })
        ];
    }
}
