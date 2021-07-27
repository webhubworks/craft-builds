<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ConfigurationPluginController;
use App\Http\Controllers\ConfigurationPluginEditionController;
use App\Http\Controllers\PluginSearchController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::get('/', fn() => Inertia::render('Home'));

});

Route::get('/stats', [StatsController::class, 'index']);

Route::get('/search', [PluginSearchController::class, '__invoke'])->name('search');

Route::post('/configurations/{configuration:uuid}', [ConfigurationPluginController::class, 'store'])
    ->name('configuration.add-plugin');

Route::delete('/configurations/{configuration:uuid}/{plugin:handle}', [ConfigurationPluginController::class, 'destroy'])
    ->name('configuration.remove-plugin');

Route::put('/configurations/{configuration:uuid}/{plugin:handle}', [ConfigurationPluginEditionController::class, 'update'])
    ->name('configuration.set-edition');

Route::post('/configurations', [ConfigurationController::class, 'store'])
    ->name('configuration.store');

Route::get('/configurations/{configuration:uuid}', [ConfigurationController::class, 'show'])
    ->name('configuration');
