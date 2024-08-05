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
        // Add admins
        AdminUser::create([
            'username' => 'admin1',
            'password' => 'hellouniverse1!',
        ]);

        AdminUser::create([
            'username' => 'admin2',
            'password' => 'hellouniverse2!',
        ]);


        // Add users
        $user1 = User::create([
            'username' => 'player1',
            'password' => 'helloworld1!',
        ]);

        $user2 = User::create([
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

        // Add games
        $game1 = Game::create([
            'title' => 'Demo Game 1',
            'slug' => 'demo-game-1',
            'thumbnail' => '/1/thumbnail.png',
            'description' => 'This is demo game 1',
            'author_id' => $dev1->id,
        ]);

        $game2 = Game::create([
            'title' => 'Demo Game 2',
            'slug' => 'demo-game-2',
            'thumbnail' => null,
            'description' => 'This is demo game 2',
            'author_id' => $dev2->id,
        ]);

        // Add game versions
        $g1v1 = GameVersion::create([
            'game_id' => $game1->id,
            'path' => '/1/v1',
            'version_number' => '1'
        ]);

        $g1v2 = GameVersion::create([
            'game_id' => $game1->id,
            'path' => '/1/v2',
            'version_number' => '2'
        ]);

        $g2v1 = GameVersion::create([
            'game_id' => $game2->id,
            'path' => '/2/v1',
            'version_number' => '1'
        ]);

        // Add game score
        GameScore::create([
            'user_id' => $user1->id,
            'game_version_id' => $g1v1->id,
            'score' => 10,
        ]);

        GameScore::create([
            'user_id' => $user1->id,
            'game_version_id' => $g1v1->id,
            'score' => 15,
        ]);

        GameScore::create([
            'user_id' => $user1->id,
            'game_version_id' => $g1v2->id,
            'score' => 12,
        ]);

        GameScore::create([
            'user_id' => $user2->id,
            'game_version_id' => $g1v2->id,
            'score' => 20,
        ]);

        GameScore::create([
            'user_id' => $user2->id,
            'game_version_id' => $g2v1->id,
            'score' => 30,
        ]);

        GameScore::create([
            'user_id' => $dev1->id,
            'game_version_id' => $g1v2->id,
            'score' => 1000,
        ]);

        GameScore::create([
            'user_id' => $dev1->id,
            'game_version_id' => $g1v2->id,
            'score' => -300,
        ]);

        GameScore::create([
            'user_id' => $dev2->id,
            'game_version_id' => $g1v2->id,
            'score' => 5,
        ]);

        GameScore::create([
            'user_id' => $dev2->id,
            'game_version_id' => $g2v1->id,
            'score' => 200,
        ]);
    }
}
