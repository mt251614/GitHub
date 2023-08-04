<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DriverSearchController;

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

Route::get('/', [LocationController::class, 'index'])->name('location.index');
Route::post('/location', [LocationController::class, 'store'])->name('location.store');

Route::post('/location/export', [LocationController::class, 'exportCSV'])->name('location.export');
