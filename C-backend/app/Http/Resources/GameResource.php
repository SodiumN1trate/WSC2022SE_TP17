<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $scoreCount = $this->versions()->get()->map(function ($version) {
            return $version->scores()->count();
        })->toArray();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->gamePath . $this->versions[count($this->versions) - 1]->path . '/thumbanail.png',
            'uploadTimestamp' => $this->created_at,
            'author' => $this->author->username,
            'scoreCount' => array_sum($scoreCount),
            'gamePath' => $this->gamePath,
        ];
    }
}
