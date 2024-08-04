<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPanelController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/', function () {
    return redirect('/admin');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin_users', [AdminPanelController::class, 'adminUsers'])->name('admin_users.list');

    // Manage platform users
    Route::get('/users', [AdminPanelController::class, 'users'])->name('users.list');
    Route::get('/user/{username}', [AdminPanelController::class, 'profile'])->name('users.profile');
    Route::post('/user/block/{id}', [AdminPanelController::class, 'block'])->name('users.block');
    Route::post('/user/unblock/{id}', [AdminPanelController::class, 'unblock'])->name('users.unblock');

    // Manage games
    Route::get('/games', [AdminPanelController::class, 'games'])->name('games.list');
    Route::get('/game/{slug}', [AdminPanelController::class, 'gameProfile'])->name('games.profile');
    Route::post('/game/delete/{id}', [AdminPanelController::class, 'gameDelete'])->name('games.delete');

    // Reset all game scores
    Route::post('/games/reset/{id}', [AdminPanelController::class, 'gameReset'])->name('games_score.reset');

    // Delete user game score
    Route::post('/score/{id}', [AdminPanelController::class, 'scoreDelete'])->name('scores.delete');

    // player scores delete
    Route::post('/player/score/{id}', [AdminPanelController::class, 'playerScoreDelete'])->name('player_scores.delete');
});


Route::post('/login/process', [AdminAuthController::class, 'login'])->name('login.process');
