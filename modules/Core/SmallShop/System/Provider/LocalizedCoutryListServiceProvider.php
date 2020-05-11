<?php

namespace Modules\Core\SmallShop\System\Providers;

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class LocalizedCoutryListServiceProvider extends ServiceProvider
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
//        Cache::rememberForever('country_list', function () {
//            $list = collect();
//
//            foreach (['en', 'cs'] as $locale) { // suported locales
//                $list[$locale] = $this->phpList($locale);
//            }
//
//            return $list;
//        });
        $this->app->singleton('locale.country_list', function ($app) {
            return new Translation\CountryList($app['config']['app.vendor']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['locale.country_list'];
    }

}
