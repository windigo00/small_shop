<?php
namespace Modules\Core\SmallShop\System\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\SmallShop\System\Providers\Translation\Translator;
//use Illuminate\Translation\Translator;
use Modules\Core\SmallShop\System\Providers\Translation\Loader;

/**
 * Description of TranslationServiceProvider
 *
 * @author windigo
 */
class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerLoader();

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            $locale = $app['config']['app.locale'];

            $trans = new Translator($loader, $locale, $app['config']['app.fallback_locale'], $app['config']['app.enabled_locale'], $app['config']['app.locale_codes']);

            return $trans;
        });


    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new Loader($app['files'], $app['path.lang'], $app['config']['app.enabled_locale'], $app['config']['app.locale_codes']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['translator', 'translation.loader'];
    }

    /**
     * Get the path to the language files.
     *
     * @return string
     */
    public function localePath(): string
    {
        return $this->app->resourcePath().DIRECTORY_SEPARATOR.'locale';
    }
}
