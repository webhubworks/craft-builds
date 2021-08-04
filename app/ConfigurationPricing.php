<?php

namespace App;

use App\Models\Configuration;
use App\Models\ConfigurationPlugin;
use Cknow\Money\Money;
use Illuminate\Support\Collection;

class ConfigurationPricing
{
    private Configuration $configuration;

    private Collection $configurationPlugins;

    public string $initial;
    public string $renewal;
    public string $biAnnual;
    public string $biAnnualPerMonth;
    public string $triAnnual;
    public string $triAnnualPerMonth;

    private function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration->loadMissing([
            'plugins.pivot.edition',
            'plugins.pivot.plugin',
        ]);

        $this->configurationPlugins = $this->configuration->plugins->pluck('pivot');

        $this->calculate();
    }

    public static function for(Configuration $configuration): static
    {
        return new static($configuration);
    }

    private function calculate()
    {
        $initial = Money::USD(
            $this->configurationPlugins->reduce(function ($carry, ConfigurationPlugin $item) {
                return $carry + (int)$item->edition->raw_price;
            }, 0)
        );

        $renewal = Money::USD(
            $this->configurationPlugins->reduce(function ($carry, ConfigurationPlugin $item) {
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
