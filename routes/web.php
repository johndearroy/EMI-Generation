<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanApplicationController;
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

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('home');
    });

    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.view');

    Route::resource('/applications', LoanApplicationController::class)
        ->only(['index', 'store', 'update']);

});
