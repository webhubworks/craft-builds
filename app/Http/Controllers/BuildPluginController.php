<?php

namespace App\Http\Controllers;

use App\Models\Build;
use App\Models\Plugin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BuildPluginController extends Controller
{
    /**
     * Adds a plugin on a build.
     */
    public function store(Request $request, Build $build): RedirectResponse
    {
        Validator::make($request->all(), [
            'handle' => 'required|string',
        ]);

        /** @var Plugin $plugin */
        $plugin = Plugin::whereHandle($request->handle)->with(['editions'])->first();

        $build->plugins()->attach(
            $plugin, [
                'edition_id' => optional($plugin->editions()->first())->id,
            ]
        );

        return Redirect::route('build', ['build' => $build])
            ->with([
                'message' => __('Plugin added'),
            ]);
    }

    /**
     * Removes a plugin on a build.
     */
    public function destroy(Request $request, Build $build, Plugin $plugin): RedirectResponse
    {

        $build->plugins()->detach($plugin);

        return Redirect::route('build', ['build' => $build])
            ->with([
                'message' => __('Plugin removed'),
            ]);
    }
}
