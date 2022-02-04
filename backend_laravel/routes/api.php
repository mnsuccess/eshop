<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/users/register', [AuthController::class, 'register'])->name('api.register.user');
Route::post('/users/login', [AuthController::class, 'login'])->name('api.login.user');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users/profile', [App\Http\Controllers\API\AuthController::class, 'profile'])->name('api.profile.user');
    Route::post('/users/logout', [App\Http\Controllers\API\AuthController::class, 'logout'])->name('api.logout.user');
});
