<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyConverter extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'currency-converter';
    }
}
