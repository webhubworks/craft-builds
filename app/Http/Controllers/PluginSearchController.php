<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Plugin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PluginSearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|min:2|max:50|string',
            'exclude' => 'nullable|array',
        ]);

        $search = Plugin::search($request->input('query'))->query(function ($builder) {
            $builder->with('editions');
        });

        return response()->json(
            collect($search->paginate(12)->items())->map(fn (Plugin $plugin) => [
                'name' => $plugin->name,
                'handle' => $plugin->handle,
                'icon_url' => $plugin->icon_url,
                'active_installs' => $plugin->active_installs,
                'editions' => $plugin->editions->map(fn (Edition $edition) => [
                    'name' => $edition->name,
                    'price' => $edition->price,
                ]),
                'abandoned' => $plugin->abandoned,
                'short_description' => $plugin->short_description,
                'disabled' => $request->has('exclude') && in_array($plugin->handle, $request->exclude),
            ])
        );
    }
}
