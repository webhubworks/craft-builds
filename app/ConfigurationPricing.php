<?php

namespace App;

use App\Models\Configuration;
use App\Models\ConfigurationPlugin;
use Cknow\Money\Money;
use Swap\Laravel\Facades\Swap;

class ConfigurationPricing
{
    private Configuration $configuration;

    private function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration->loadMissing([
            'plugins.pivot.edition',
            'plugins.pivot.plugin',
        ]);

        $configurationPlugins = $this->configuration->plugins->pluck('pivot');

        $initialCost = Money::USD(
            $configurationPlugins->reduce(function($carry, ConfigurationPlugin $item) {
                return $carry + (int) $item->edition->raw_price;
            }, 0)
        );

        $renewalCost = Money::USD(
            $configurationPlugins->reduce(function($carry, ConfigurationPlugin $item) {
                return $carry + (int) $item->edition->raw_renewal_price;
            }, 0)
        );

        $biAnnualCost = $initialCost->add($renewalCost);

        $biAnnualCostPerMonth = $biAnnualCost->divide(24);

        $triAnnualCost = $biAnnualCost->add($renewalCost);

        $triAnnualCostPerMonth = $triAnnualCost->divide(36);
dd(Swap::latest('EUR/USD'));
        dd(
            $initialCost->format(),
            $renewalCost->format(),
            $biAnnualCost->format(),
            $biAnnualCostPerMonth->format(),
            $triAnnualCost->format(),
            $triAnnualCostPerMonth->format(),
        );
    }

    public static function for(Configuration $configuration): static
    {
        return new static($configuration);
    }
}
