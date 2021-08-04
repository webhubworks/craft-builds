<?php

namespace App;

use Cknow\Money\Money;
use Money\Converter;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Exchange\SwapExchange;

class CurrencyConverter
{
    private Converter $converter;

    public function __construct()
    {
        $this->converter = new Converter(new ISOCurrencies(), new SwapExchange(resolve('swap')));
    }

    public function convert(Money $money): Money
    {
        $toCurrency = new Currency(config('app.currency'));

        if ($money->getCurrency()->equals($toCurrency)) {
            return $money;
        }

        return Money::fromMoney(
            $this->converter->convert($money->getMoney(), $toCurrency)
        );
    }
}
