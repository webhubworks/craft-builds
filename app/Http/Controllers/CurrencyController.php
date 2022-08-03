<?php

namespace App\Http\Controllers;

use App\Models\Build;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Validator;

class CurrencyController extends Controller
{
    public function update(Request $request, Build $build): RedirectResponse
    {
        $request->validate([
            'currency' => ['required', 'string', Rule::in(config('money.currencies.iso'))],
        ]);

        return Redirect::route('build', ['build' => $build])
            ->with([
                'message' => __('Currency updated to ' . $request->currency),
            ]);
    }
}
