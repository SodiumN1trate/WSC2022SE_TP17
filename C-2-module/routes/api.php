<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/signin', [AuthController::class, 'signin']);
Route::post('/auth/signup', [AuthController::class, 'signup']);

Route::get('/games', [GameController::class, 'index']);

Route::get('/games/{slug}', [GameController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/signout', [AuthController::class, 'signout']);

    Route::post('/games', [GameController::class, 'create']);

    Route::middleware('isdev')->group(function () {
        Route::put('/games/{slug}', [GameController::class, 'update']);
        Route::delete('/games/{slug}', [GameController::class, 'delete']);
    });
});
