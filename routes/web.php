<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\DashboardOperatorController;
use App\Http\Controllers\DashboardWaliController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\WaliStudentController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('operator')->middleware(['auth', 'auth.operator'])->group(function () {
    Route::get('dashboard', [DashboardOperatorController::class, 'index'])->name('operator.dashboard');
    Route::resource('user', UserController::class);
    Route::resource('wali', WaliController::class);
    Route::resource('student', StudentController::class);
    Route::resource('walistudent', WaliStudentController::class);
    Route::resource('cost', CostController::class);
    Route::resource('invoice', InvoiceController::class);
});

Route::prefix('walimurid')->middleware(['auth', 'auth.wali'])->group( function() {
    Route::get('dashboard', [DashboardWaliController::class, 'index'])->name('wali.dashboard');
});

Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function() {
    // 
});

Auth::routes();

Route::get('logout', function() {
    Auth::logout();
    return redirect()->route('home');
});
