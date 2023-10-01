<?php

use App\Http\Controllers\Auth\AuthController as Auth;
use App\Http\Controllers\Dash\OverviewController as Overview;
use Illuminate\Support\Facades\Route;

Route::get('/', [Auth::class, 'showLogin'])->name('login');
Route::post('/handleLogin', [Auth::class, 'handleLogin'])->name('handleLogin');
Route::post('/handleLogout', [Auth::class, 'handleLogout'])->name('handleLogout');

// dashboard page
// Route::middleware('auth')->group(function () {
Route::get('/overview', [Overview::class, 'showOverview'])->name('overview');
// });
