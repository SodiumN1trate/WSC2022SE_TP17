<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::post('/auth/signup', [AuthController::class, 'signUp']);
Route::post('/auth/signin', [AuthController::class, 'signIn']);
Route::get('/games', [GameController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/signout', [AuthController::class, 'signOut']);

    // Game crud
    Route::post('/games', [GameController::class, 'create']);
    Route::get('/games/{slug}', [GameController::class, 'show']);
    Route::post('/games/{slug}/upload', [GameController::class, 'upload']);
    Route::put('/games/{slug}', [GameController::class, 'update']);
    Route::delete('/games/{slug}', [GameController::class, 'delete']);

    // Serve game files
    Route::get('/games/{slug}/{version}', [GameController::class, 'serveFiles']);

    // Users
    Route::get('/users/{username}', [UserController::class, 'show']);

    // Scores
    Route::get('/games/{slug}/scores', [GameController::class, 'scores']);
});





