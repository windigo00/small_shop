<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class LocalizedCoutryList extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Cache::rememberForever('country_list', function () {
            $list = collect();

            foreach (['en', 'cs'] as $locale) { // suported locales
                $list[$locale] = $this->phpList($locale);
            }

            return $list;
        });
    }

    private function phpList($locale)
    {
        return include "../vendor/umpirsky/country-list/data/{$locale}/country.php";
    }
}
