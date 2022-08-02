<?php

namespace App;

use App\Models\Build;
use App\Models\BuildPlugin;
use Cknow\Money\Money;
use Illuminate\Support\Collection;

class BuildPricing
{
    private Build $build;

    private Collection $buildPlugins;

    public string $initial;
    public string $renewal;
    public string $biAnnual;
    public string $biAnnualPerMonth;
    public string $triAnnual;
    public string $triAnnualPerMonth;

    private function __construct(Build $build)
    {
        $this->build = $build->loadMissing([
            'plugins.pivot.edition',
            'plugins.pivot.plugin',
        ]);

        $this->buildPlugins = $this->build->plugins->pluck('pivot');

        $this->calculate();
    }

    public static function for(Build $build): static
    {
        return new static($build);
    }

    private function calculate()
    {
        $initial = Money::USD(
            $this->buildPlugins->reduce(function ($carry, BuildPlugin $item) {
                return $carry + (int)$item->edition->raw_price;
            }, 0)
        );

        $renewal = Money::USD(
            $this->buildPlugins->reduce(function ($carry, BuildPlugin $item) {
                return $carry + (int)$item->edition->raw_renewal_price;
            }, 0)
        );

        $biAnnual = $initial->add($renewal);

        $biAnnualPerMonth = $biAnnual->divide(24);

        $triAnnual = $biAnnual->add($renewal);

        $triAnnualPerMonth = $triAnnual->divide(36);

        $this->initial = \App\Facades\CurrencyConverter::convert($initial)->format();
        $this->renewal = \App\Facades\CurrencyConverter::convert($renewal)->format();
        $this->biAnnual = \App\Facades\CurrencyConverter::convert($biAnnual)->format();
        $this->biAnnualPerMonth = \App\Facades\CurrencyConverter::convert($biAnnualPerMonth)->format();
        $this->triAnnual = \App\Facades\CurrencyConverter::convert($triAnnual)->format();
        $this->triAnnualPerMonth = \App\Facades\CurrencyConverter::convert($triAnnualPerMonth)->format();
    }
}
