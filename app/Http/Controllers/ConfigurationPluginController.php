<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Plugin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ConfigurationPluginController extends Controller
{
    /**
     * Adds a plugin on a configuration.
     *
     * @param Request $request
     * @param Configuration $configuration
     * @param Plugin $plugin
     * @return RedirectResponse
     */
    public function store(Request $request, Configuration $configuration): RedirectResponse
    {
        Validator::make($request->all(), [
            'handle' => 'required|string',
        ]);

        /** @var Plugin $plugin */
        $plugin = Plugin::whereHandle($request->handle)->with(['editions'])->first();

        $configuration->plugins()->attach(
            $plugin, [
                'edition_id' => optional($plugin->editions()->first())->id,
            ]
        );

        return Redirect::route('configuration', ['configuration' => $configuration])
            ->with([
                'message' => __('Plugin added')
            ]);
    }

    /**
     * Removes a plugin on a configuration.
     *
     * @param Request $request
     * @param Configuration $configuration
     * @param Plugin $plugin
     * @return RedirectResponse
     */
    public function destroy(Request $request, Configuration $configuration, Plugin $plugin): RedirectResponse
    {

        $configuration->plugins()->detach($plugin);

        return Redirect::route('configuration', ['configuration' => $configuration])
            ->with([
                'message' => __('Plugin removed')
            ]);
    }
}
