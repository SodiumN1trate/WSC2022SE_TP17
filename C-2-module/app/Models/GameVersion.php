<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'version',
        'path',
        'number',
    ];

    public function scores()
    {
        return $this->hasMany(GameScore::class, 'game_version_id');
    }
}
