<?php

namespace App\Providers;

use App\CurrencyConverter;
use Illuminate\Support\ServiceProvider;

class CurrencyConverterService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('currency-converter', function ($app) {
            return new CurrencyConverter();
        });
    }
}
