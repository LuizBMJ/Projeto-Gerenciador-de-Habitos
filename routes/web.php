<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;


// SITE
Route::get('/', [SiteController::class, 'index'])->name('site.index');

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');

Route::middleware('auth')->group(function() {
    
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('site.dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('auth.logout');
});