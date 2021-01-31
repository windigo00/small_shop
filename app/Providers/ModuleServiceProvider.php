<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Module;

/**
 * Description of ModuleServiceProvider
 *
 * @author windigo
 */
abstract class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Short name for module. prefered lowercase
     * @var string
     */
    protected $module_name;

    /**
     * __DIR__ constant frm extending class
     * @var string
     */
    protected $module_directory;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        $a = new \ReflectionClass($this);
        // extending class directory
//        $dir = dirname($a->getFileName());
        $module_root = $this->module_directory . '/../';
        $this->loadMigrationsFrom($module_root . 'database/migrations');

        $this->loadFactoriesFrom([
            $module_root . 'database/factories'
        ]);
        $this->loadTranslationsFrom(realpath($module_root . 'i18n'), $this->module_name);
        $this->loadViewsFrom($module_root . 'resources/views', $this->module_name);
        
        $this->app->singleton('module.'.$this->module_name, function ($app) {

        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['module.'.$this->module_name];
    }
}
