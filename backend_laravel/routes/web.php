<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

Route::middleware('auth', 'isAdmin')->group(function () {
    Route::resource('admin/product', ProductController::class)->except('show');
    Route::get('admin/audit', [AuditTrailController::class ,'index'])->name('audit.index');
    Route::get('admin/order', [OrderController::class ,'index'])->name('order.index');
    Route::get('/dashboard', function () {
        //return view('dashboard');
        return redirect('admin/product');
    })->name('dashboard');
});

Route::any('/register', function () {
    return  view('auth.login');
});
