<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'is_deleted',
        'description',
        'thumbnail',
        'slug',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function versions()
    {
        return $this->hasMany(GameVersion::class, 'game_id');
    }
}
