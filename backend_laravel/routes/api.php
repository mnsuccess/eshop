<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\ProductController;

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
    Route::get('/users/profile', [AuthController::class, 'profile'])->name('api.profile.user');
    Route::post('/users/logout', [AuthController::class, 'logout'])->name('api.logout.user');
    Route::get('/transaction', [TransactionController::class, 'viewTransactions'])->name('api.transaction.user');
    Route::post('/transaction/topup', [TransactionController::class, 'topup'])->name('api.transaction.topup.user');
    Route::post('/transaction/purchase', [TransactionController::class, 'purchase'])->name('api.transaction.purchase.user');
});
Route::apiResource('/products', ProductController::class);
