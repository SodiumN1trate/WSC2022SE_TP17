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

});


Route::post('/login/process', [AdminAuthController::class, 'login'])->name('login.process');
