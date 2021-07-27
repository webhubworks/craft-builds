<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Plugin;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StatsController extends Controller
{
    public function index(Request $request): Response
    {
        $stats = [
            'totalNumber' => Plugin::where('handle', '!=', 'cms')
                ->count(),
            'mostExpensive' => function () {
                $edition = Edition::with('plugin')
                    ->orderBy('price', 'desc')
                    ->first();
                return [
                    'price' => $edition->price,
                    'name' => $edition->plugin->name,
                ];
            },
            'mostInstalls' => function () {
                $plugin = Plugin::orderBy('active_installs', 'desc')
                    ->first();
                return [
                    'count' => $plugin->active_installs,
                    'name' => $plugin->name,
                ];
            },
            'activeInstallsChart' => [
                'series' => [[
                    'data' => Plugin::all()->groupBy('developer_name')->map(function ($plugins, $developer) {
                        return [
                            'x' => $plugins->count(),
                            'y' => $developer,
                        ];
                    })->sortByDesc('count')->values()
                ]]
            ],
        ];

        return Inertia::render('Stats', $stats);
    }
}
