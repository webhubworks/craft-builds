<?php

namespace App\Providers;

use App\CurrencyConverter;
use Illuminate\Support\ServiceProvider;

class CurrencyConverterService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('currency-converter', function ($app) {
            return new CurrencyConverter();
        });
    }
}
