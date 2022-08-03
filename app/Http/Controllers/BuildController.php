<?php

namespace App\Http\Controllers;

use App\BuildPricing;
use App\Models\Build;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class BuildController extends Controller
{
    public function show(Request $request, string $uuid, ?string $currency = null): Response
    {
        $currency = $currency ?? config('money.defaultCurrency');
        try {
            Validator::make(['currency' => $currency], ['currency' => [Rule::in(config('money.currencies.iso'))]])->validate();
        } catch (ValidationException $e) {
            abort(404);
        }
        Config::set('app.currency', $currency);

        $build = Build::whereUuid($uuid)
            ->with(['plugins.editions',])
            ->firstOrFail();

        return Inertia::render('Build', [
            'build' => $build,
            'selectedPluginHandles' => $build->plugins->pluck('handle'),
            'calculation' => BuildPricing::for($build)->locale(\App::getLocale())->calculate(),
            'currencies' => config('money.currencies.iso'),
            'selectedCurrency' => config('app.currency'),
            'locales' => config('laravellocalization.supportedLocales'),
            'selectedLocale' => \App::getLocale(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return Redirect::route('build', [
            'build' => Build::create(),
        ])->with([
            'message' => __('Plugin added'),
        ]);
    }
}
