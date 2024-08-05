<?php

namespace App\Http\Resources;

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
        $highscores = [];
        $scores = $this->scores()->get();
        foreach ($scores as $score) {
            $updated = false;
            foreach ($highscores as $key => $highscore) {
                if($highscore['game_version_id'] === $score->game_version_id && $highscore['score'] < $score->score) {
                    $highscores[$key]['score'] = $score->score;
                    $updated = true;
                }
            }
            if($updated === false) {
                $highscores[] = [
                    'game_version_id' => $score->game_version_id,
                    'score' => $score->score,
                ];
            }
        }
        return [
            'username' => $this->username,
            'registeredTimestamp' => $this->created_at,
            'authoredGames' => GameResource::collection($this->games ?? null),
            'highscores' => $highscores,
        ];
    }
}
