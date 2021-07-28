<?php

namespace App\Http\Controllers;

use App\ConfigurationPricing;
use App\Models\Configuration;
use App\Models\ConfigurationPlugin;
use App\Models\Plugin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class ConfigurationController extends Controller
{

    public function show(Request $request, string $uuid): Response
    {
        $configuration = Configuration::whereUuid($uuid)
            ->with(['plugins.editions'])
            ->firstOrFail();

ConfigurationPricing::for($configuration);
        return Inertia::render('Configuration', [
            'configuration' => $configuration,
            'calculation' => [
                'initialCost' => 500,
                'renewalCost' => 100,
                'costForTwoYears' => 600,
                'costForThreeYears' => 700,
            ]
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
