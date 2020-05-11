<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Description of NavigationServiceProvider
 *
 * @author windigo
 */
class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('navigation', function ($app) {
            return new Navigation\Navigation;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['navigation'];
    }
}
