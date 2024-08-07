<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
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

Route::post('/login/process', [AdminAuthController::class, 'login'])->name('login.process');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin_list', [AdminController::class, 'index'])->name('admins.list');

    Route::get('/users_list', [UserController::class, 'index'])->name('users.list');;
    Route::get('/user/{username}', [UserController::class, 'show'])->name('users.profile');

    Route::post('/user/{id}/block', [UserController::class, 'block'])->name('users.block');
    Route::post('/user/{id}/unblock', [UserController::class, 'unblock'])->name('users.unblock');


    Route::get('/games_list', [GameController::class, 'index'])->name('games.list');
    Route::get('/games/{slug}', [GameController::class, 'show'])->name('games.profile');

    Route::post('/games/{game}', [GameController::class, 'delete'])->name('games.delete');
    Route::post('/games/{game}/reset', [GameController::class, 'reset'])->name('games.reset');
    Route::post('/games/{score}/reset_single', [GameController::class, 'deleteSingleScore'])->name('games.deleteSingleScore');
    Route::post('/games/{user}/reset_user', [GameController::class, 'deleteUserScore'])->name('games.deleteUserScore');

});
