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

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/admin', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return redirect('/admin');
});

Route::post('/login', [AdminAuthController::class, 'login'])->name('login.process');

Route::middleware('auth:admins')->group(function () {
    Route::get('/admin_list', [AdminPanelController::class, 'adminIndex'])->name('admins.list');

    Route::get('/users_list', [AdminPanelController::class, 'usersIndex'])->name('users.list');

    Route::get('/user/{username}', [AdminPanelController::class, 'userProfile'])->name('users.profile');

    Route::post('/user/{user}/block', [AdminPanelController::class, 'userBlock'])->name('users.block');
    Route::post('/user/{user}/unblock', [AdminPanelController::class, 'userUnblock'])->name('users.unblock');

    Route::get('/games_list', [AdminPanelController::class, 'gamesIndex'])->name('games.list');
    Route::get('/game/{slug}', [AdminPanelController::class, 'gameProfile'])->name('games.profile');

    Route::post('/game/{game}/delete', [AdminPanelController::class, 'gameDelete'])->name('games.delete');

    Route::post('/game/{game}/reset', [AdminPanelController::class, 'gameReset'])->name('games.reset');

    Route::post('/player/{user}/reset', [AdminPanelController::class, 'userReset'])->name('player.reset');

    Route::post('/score/{score}/delete', [AdminPanelController::class, 'scoreDelete'])->name('score.delete');

});
