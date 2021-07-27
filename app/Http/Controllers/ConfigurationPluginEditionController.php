<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Plugin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ConfigurationPluginEditionController extends Controller
{
    /**
     * @param Request $request
     * @param Configuration $configuration
     * @param Plugin $plugin
     * @return RedirectResponse
     */
    public function update(Request $request, Configuration $configuration, Plugin $plugin): RedirectResponse
    {
        Validator::make($request->all(), [
            'edition' => 'required|exists:editions',
        ]);



        return Redirect::route('configuration', ['configuration' => $configuration])
            ->with([
                'message' => __('Edition set')
            ]);
    }
}
