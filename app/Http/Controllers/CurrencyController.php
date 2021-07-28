<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Validator;

class CurrencyController extends Controller
{
    public function update(Request $request, Configuration $configuration): RedirectResponse
    {
        Validator::make($request->all(), [
            'currency' => ['required', 'string', Rule::in(config('money.currencies.iso'))],
        ]);

        $configuration->forceFill([
            'currency' => $request->currency,
        ])->save();

        return Redirect::route('configuration', ['configuration' => $configuration])
            ->with([
                'message' => __('Currency updated to ' . $request->currency),
            ]);
    }
}
