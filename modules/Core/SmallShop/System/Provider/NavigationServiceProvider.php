<?php
namespace Modules\Core\SmallShop\System\Provider;

use Illuminate\Support\ServiceProvider;

/**
 * Description of NavigationServiceProvider
 *
 * @author windigo
 */
class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['navigation']->addItem([
            'uri' => 'admin/system',
            'title' => 'System',
            'items' => [
                [
                    'uri' => 'admin.system.settings.index',
                    'title' => 'Settings'
                ],
                [
                    'uri' => 'admin.system.locale.index',
                    'title' => 'Locale'
                ],
            ]
        ]);
    }

}
