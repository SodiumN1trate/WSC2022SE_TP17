<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'number',
        'path',
    ];

    public function scores()
    {
        return $this->hasMany(GameScore::class, 'version_id');
    }
}
