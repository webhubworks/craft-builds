<?php

use App\Http\Controllers\BuildController;
use App\Http\Controllers\BuildPluginController;
use App\Http\Controllers\BuildPluginEditionController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PluginSearchController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect']], function () {

    Route::get('/', fn () => Inertia::render('Home'));

    Route::inertia('/imprint', 'Imprint');
    Route::inertia('/data-privacy', 'DataPrivacy');

    Route::prefix('/builds')->group(function () {

        Route::post('/', [BuildController::class, 'store'])
            ->name('build.store');

        Route::post('/{build:uuid}', [BuildPluginController::class, 'store'])
            ->name('build.add-plugin')
            ->whereUuid('build');

        Route::get('/{build:uuid}/{currency?}', [BuildController::class, 'show'])
            ->name('build')
            ->whereUuid('build');

        Route::put('/{build:uuid}/currency', [CurrencyController::class, 'update'])
            ->name('build.set-currency')
            ->whereUuid('build');

        Route::delete('/{build:uuid}/{plugin:handle}', [BuildPluginController::class, 'destroy'])
            ->name('build.remove-plugin')
            ->whereUuid('build');

        Route::put('/{build:uuid}/{plugin:handle}', [BuildPluginEditionController::class, 'update'])
            ->name('build.set-edition')
            ->whereUuid('build');

    });
});

Route::get('/stats', [StatsController::class, 'index']);

Route::get('/search', [PluginSearchController::class, '__invoke'])->name('search');
