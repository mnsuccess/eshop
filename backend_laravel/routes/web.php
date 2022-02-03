<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuditTrailController;

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

Route::middleware('auth')->group(function () {
    Route::resource('admin/product', ProductController::class)->except('show');
    Route::get('admin/audit', [AuditTrailController::class ,'index'])->name('audit.index');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::any('/register', function () {
    return  view('auth.login');
});
