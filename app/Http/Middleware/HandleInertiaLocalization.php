<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class HandleInertiaLocalization
{
    public function handle(Request $request, Closure $next): Response
    {
        Inertia::share([
            'i18n' => [
                'locale' => fn () => \App::getLocale(),
                'lines' => fn () => $this->getLangLines(),
            ],
        ]);

        return $next($request);
    }

    private function getLangLines()
    {
        return Cache::remember('lang-lines-'.\App::getLocale(), 3600,
            function () {
                $json = resource_path('lang/'.\App::getLocale().'.json');
                if (! file_exists($json)) {
                    return [];
                }

                return json_decode(file_get_contents($json), true);
            });
    }
}
