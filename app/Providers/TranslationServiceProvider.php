<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Translation\Translator;
use App\Providers\Translation\Loader;

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
        $this->app->instance('path.locale', $this->localePath());

        $this->registerLoader();

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            $locale = $app['config']['app.locale'];

            $trans = new Translator($loader, $locale);

            $trans->setFallback($app['config']['app.fallback_locale']);

            $trans->setEnabledLocales($app['config']['app.enabled_locale']);

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
            return new Loader($app['files'], $app['path.lang']);
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
