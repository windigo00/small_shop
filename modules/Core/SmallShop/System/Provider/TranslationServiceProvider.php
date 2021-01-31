<?php
namespace Modules\Core\SmallShop\System\Provider;

use Illuminate\Support\ServiceProvider;
use Modules\Core\SmallShop\System\Provider\Translation\Translator;
//use Illuminate\Translation\Translator;
use Modules\Core\SmallShop\System\Provider\Translation\Loader;
use Modules\Core\SmallShop\System\Services\LanguageService;

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
        $this->registerLanguages();

        $this->app->singleton(
            'translator',
            fn ($app) => new Translator(
                $app['translation.loader'],
                $app['config']['app.locale'],
                $app['config']['app.fallback_locale']
            )
        );
    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton(
            'translation.loader',
            fn ($app) => new Loader(
                $app['files'],
                $app['path.lang'],
                $app['config']['app.enabled_locale'],
                $app['config']['app.locale_codes']
            )
        );
    }

    /**
     * Register the language service.
     *
     * @return void
     */
    protected function registerLanguages()
    {
        $this->app->singleton(
            'translation.languages',
            fn ($app) => new LanguageService(
                $app['config']['app.locale_codes'],
                $app['config']['app.enabled_locale']
            )
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['translator', 'translation.loader', 'translation.languages'];
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
