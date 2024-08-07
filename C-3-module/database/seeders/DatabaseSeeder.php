<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AdminUser;
use App\Models\Game;
use App\Models\GameScore;
use App\Models\GameVersion;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       AdminUser::create([
           'username' => 'admin1',
           'password' => 'hellouniverse1!',
       ]);

        AdminUser::create([
            'username' => 'admin2',
            'password' => 'hellouniverse2!',
        ]);

        $p1 = User::create([
            'username' => 'player1',
            'password' => 'helloworld1!',
        ]);

        $p2 = User::create([
            'username' => 'player2',
            'password' => 'helloworld2!',
        ]);

        $dev1 = User::create([
            'username' => 'dev1',
            'password' => 'hellobyte1!',
        ]);

        $dev2 = User::create([
            'username' => 'dev2',
            'password' => 'hellobyte2!',
        ]);

        $game1 = Game::create([
            'title' => 'Demo game 1',
            'slug' => 'demo-game-1',
            'description' => 'This is demo game 1',
            'thumbnail' => '/games/demo-game-1/v2/thumbnail.png',
            'author_id' => $dev1->id,
        ]);

        $game2 = Game::create([
            'title' => 'Demo game 2',
            'slug' => 'demo-game-2',
            'description' => 'This is demo game 2',
            'thumbnail' => '/games/demo-game-2/v1/thumbnail.png',
            'author_id' => $dev2->id,
        ]);

        $g1v1 = GameVersion::create([
            'game_id' => $game1->id,
            'path' => '/games/demo-game-1/v1',
            'number' => 1,
        ]);


        $g1v2 = GameVersion::create([
            'game_id' => $game1->id,
            'path' => '/games/demo-game-1/v2',
            'number' => 2,
        ]);

        $g2v1 = GameVersion::create([
            'game_id' => $game2->id,
            'path' => '/games/demo-game-2/v1',
            'number' => 1,
        ]);

        GameScore::create([
            'user_id' => $p1->id,
            'version_id' => $g1v1->id,
            'score' => 10,
        ]);

        GameScore::create([
            'user_id' => $p1->id,
            'version_id' => $g1v1->id,
            'score' => 15,
        ]);

        GameScore::create([
            'user_id' => $p1->id,
            'version_id' => $g1v2->id,
            'score' => 12,
        ]);

        GameScore::create([
            'user_id' => $p2->id,
            'version_id' => $g1v2->id,
            'score' => 20,
        ]);

        GameScore::create([
            'user_id' => $p2->id,
            'version_id' => $g2v1->id,
            'score' => 30,
        ]);

        GameScore::create([
            'user_id' => $dev1->id,
            'version_id' => $g1v2->id,
            'score' => 1000,
        ]);

        GameScore::create([
            'user_id' => $dev1->id,
            'version_id' => $g1v2->id,
            'score' => -300,
        ]);

        GameScore::create([
            'user_id' => $dev2->id,
            'version_id' => $g1v2->id,
            'score' => 5,
        ]);

        GameScore::create([
            'user_id' => $dev2->id,
            'version_id' => $g2v1->id,
            'score' => 200,
        ]);

    }
}
