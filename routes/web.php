<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HabitControler;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
    WEBSITE
*/

Route::middleware('security.headers')->get('/', [SiteController::class, 'index'])->name('site.index');

/*
    AUTH
*/

Route::middleware('security.headers')
    ->prefix('login')->name('login.')
    ->group(function () {
        Route::get('/', [LoginController::class, 'index'])->name('index');
        Route::post('/', [LoginController::class, 'login'])->name('store')->middleware('throttle:5,1');
    });

Route::middleware('security.headers')
    ->prefix('cadastro')->name('register.')
    ->group(function () {
        Route::get('/', [RegisterController::class, 'index'])->name('index');
        Route::post('/', [RegisterController::class, 'store'])->name('store')->middleware('throttle:5,1');
    });

Route::middleware(['web', 'security.headers'])
    ->prefix('auth/google')->name('auth.')
    ->group(function () {
        Route::get('redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
        Route::get('callback', [GoogleController::class, 'callback'])->name('google.callback');
        Route::get('vincular', [GoogleController::class, 'showLink'])->name('google.link');
        Route::post('vincular', [GoogleController::class, 'link'])->name('google.link.store')->middleware('throttle:5,1');
    });

/*
    DASHBOARD (AUTH REQUIRED)
*/

Route::middleware(['auth', 'security.headers'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        /*
        HABITS
        */

        Route::prefix('habits')
            ->name('habits.')
            ->group(function () {

                // EXTRA
                Route::get('paginate', [HabitControler::class, 'paginate'])->name('paginate');
                Route::post('{habit}/toggle', [HabitControler::class, 'toggle'])->name('toggle');

                // HISTORY
                Route::prefix('historico')->name('history.')->group(function () {
                    Route::get('day', [HabitControler::class, 'historyDay'])->name('day');
                    Route::get('{year?}', [HabitControler::class, 'history'])->name('index');
                });

                // SETTINGS
                Route::get('configurar', [HabitControler::class, 'settings'])->name('settings');

                // CALENDAR
                Route::prefix('calendar')->name('calendar.')->group(function () {
                    Route::get('/', [HabitControler::class, 'calendar'])->name('index');
                    Route::get('events', [HabitControler::class, 'calendarEvents'])->name('events');
                    Route::post('toggle-date', [HabitControler::class, 'calendarToggle'])->name('toggle');
                });
            });

        // HABITS CRUD
        Route::resource('habits', HabitControler::class)->except('show');

    });
