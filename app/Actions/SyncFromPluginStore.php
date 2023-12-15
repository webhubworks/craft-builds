<?php

namespace App\Actions;

use App\Models\Category;
use App\Models\Edition;
use App\Models\Plugin;
use Carbon\Carbon;
use Cknow\Money\Money as CMoney;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Money\Currency;

class SyncFromPluginStore
{
    public function sync(): void
    {
        $response = Cache::rememberForever('response', fn () => Http::get('https://api.craftcms.com/v1/plugin-store/')->json());

        $this->insertCraftAsPlugin();

        $this->insertCategories($response['categories']);

        $this->insertPlugins($response['plugins']);

        $this->insertEditions($response['plugins']);
    }

    private function insertCraftAsPlugin(): void
    {
        $craftPackagistInfo = Http::get('https://repo.packagist.org/p2/craftcms/cms.json');

        $craftCms = Plugin::updateOrCreate([
            'source_id' => 1,
        ], [
            'name' => 'Craft CMS',
            'handle' => 'cms',
            'package_name' => 'craftcms/cms',
            'short_description' => 'Everything you’ll need. Nothing you won’t.',
            'currency' => 'USD',
            'developer_name' => 'Pixel & Tonic',
            'keywords' => ['cms'],
            'version' => Arr::get($craftPackagistInfo->json(), 'packages.craftcms/cms.0.version'),
            'active_installs' => null,
            'icon_url' => '/logos/craft-cms.jpg',
            'abandoned' => false,
            'last_update_at' => Carbon::parse(Arr::get($craftPackagistInfo->json(), 'packages.craftcms/cms.0.time')),
        ]);

        Edition::updateOrCreate([
            'source_id' => 1,
        ], [
            'plugin_id' => $craftCms->id,
            'name' => 'Solo',
            'price' => null,
            'handle' => 'solo',
            'features' => [],
            'renewalPrice' => null,
        ]);
        Edition::updateOrCreate([
            'source_id' => 2,
        ], [
            'plugin_id' => $craftCms->id,
            'name' => 'Pro',
            'price' => CMoney::parseByDecimal('299', new Currency('USD'))->getAmount(),
            'features' => [],
            'handle' => 'pro',
            'renewal_price' => CMoney::parseByDecimal('59', new Currency('USD'))->getAmount(),
        ]);
    }

    private function insertCategories(array $categories): void
    {
        collect($categories)->each(fn ($category) => Category::updateOrCreate([
            'source_id' => $category['id'],
        ], [
            'title' => $category['title'],
            'description' => $category['description'],
            'slug' => $category['slug'],
            'icon_url' => $category['iconUrl'],
        ]));
    }

    private function insertPlugins(array $plugins): void
    {
        collect($plugins)->each(function ($plugin) {
            /** @var Plugin $pluginModel */
            $pluginModel = Plugin::updateOrCreate([
                'source_id' => $plugin['id'],
            ], [
                'name' => $plugin['name'],
                'handle' => $plugin['handle'],
                'package_name' => $plugin['packageName'],
                'short_description' => $plugin['shortDescription'],
                'currency' => $plugin['currency'],
                'developer_name' => $plugin['developerName'],
                'keywords' => $plugin['keywords'],
                'version' => $plugin['version'],
                'active_installs' => $plugin['activeInstalls'],
                'icon_url' => $plugin['iconUrl'],
                'abandoned' => $plugin['abandoned'],
                'last_update_at' => $plugin['lastUpdate'] ? Carbon::parse($plugin['lastUpdate']) : null,
            ]);

            $categoryIds = Category::whereIn('source_id', $plugin['categoryIds'])->get('id');

            $pluginModel->categories()->sync($categoryIds);
        });
    }

    private function insertEditions(array $plugins): void
    {
        collect($plugins)->each(function ($plugin) {
            $pluginModel = Plugin::whereSourceId($plugin['id'])->firstOrFail();
            collect($plugin['editions'])->each(function ($edition) use ($pluginModel) {
                Edition::updateOrCreate([
                    'source_id' => $edition['id'],
                ], [
                    'plugin_id' => $pluginModel->id,
                    'name' => $edition['name'],
                    'handle' => $edition['handle'],
                    'price' => $edition['price'] ? CMoney::parseByDecimal((string) $edition['price'], new Currency($pluginModel['currency']))->getAmount() : null,
                    'renewal_price' => $edition['renewalPrice'] ? CMoney::parseByDecimal((string) $edition['renewalPrice'], new Currency($pluginModel['currency']))->getAmount() : null,
                    'features' => $edition['features'],
                ]);
            });
        });
    }
}
