<?php

namespace App\Http\Controllers;

use App\ConfigurationPricing;
use App\Models\Configuration;
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

class ConfigurationController extends Controller
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

        $configuration = Configuration::whereUuid($uuid)
            ->with(['plugins.editions',])
            ->firstOrFail();

        return Inertia::render('Configuration', [
            'configuration' => $configuration,
            'calculation' => ConfigurationPricing::for($configuration),
            'currencies' => config('money.currencies.iso'),
            'selectedCurrency' => config('app.currency'),
            'locales' => config('laravellocalization.supportedLocales'),
            'selectedLocale' => \App::getLocale(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return Redirect::route('configuration', [
            'configuration' => Configuration::create(),
        ])->with([
            'message' => __('Plugin added'),
        ]);
    }
}
