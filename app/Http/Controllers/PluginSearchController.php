<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PluginSearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        Validator::make($request->all(), [
            'query' => 'required|min:2|max:50|string',
        ])->validate();

        $search = Plugin::search($request->input('query'))->query(function ($builder) {
            $builder->with('editions');
        });

        return response()->json(
            $search->paginate(12)
        );
    }
}
