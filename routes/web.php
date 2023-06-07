<?php

use App\Http\Controllers\DashboardOperatorController;
use App\Http\Controllers\DashboardWaliController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::prefix('operator')->middleware(['auth', 'auth.operator'])->group(function () {
    Route::get('operator', [DashboardOperatorController::class, 'index'])->name('operator.dashboard');
});

Route::prefix('wali')->middleware(['auth', 'auth.wali'])->group( function() {
    Route::get('wali', [DashboardWaliController::class, 'index'])->name('wali.dashboard');
});

Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function() {
    // 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', function() {
    Auth::logout();
    return redirect()->route('home');
});
