<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AdminUser;
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
    }
}
