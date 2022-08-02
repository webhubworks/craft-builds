<?php

namespace App\Http\Controllers;

use App\Models\Build;
use App\Models\Plugin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class BuildPluginEditionController extends Controller
{
    /**
     * @param Request $request
     * @param Build $build
     * @param Plugin $plugin
     * @return RedirectResponse
     */
    public function update(Request $request, Build $build, Plugin $plugin): RedirectResponse
    {
        Validator::make($request->all(), [
            'edition' => 'required',
        ]);

        if (! $plugin->editions()->whereId($request->edition)->exists()) {
            throw new \Exception("Invalid edition");
        }

        $build->plugins()->detach($plugin);

        $build->plugins()->attach(
            $plugin, [
                'edition_id' => $request->edition,
            ]
        );

        return Redirect::route('build', ['build' => $build])
            ->with([
                'message' => __('Edition set')
            ]);
    }
}
