<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HabitControler;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
    WEBSITE
*/

Route::get('/', [SiteController::class, 'index'])->name('site.index');

/*
    AUTH
*/

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('site.login');
    Route::post('/', [LoginController::class, 'login'])->name('auth.login');
});

Route::prefix('cadastro')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->name('site.register');
    Route::post('/', [RegisterController::class, 'store'])->name('auth.register');
});

/*
    DASHBOARD (AUTH REQUIRED)
*/

Route::middleware('auth')
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