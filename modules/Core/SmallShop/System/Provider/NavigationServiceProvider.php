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
        $nav = $this->app['navigation'];
        $item = $nav->addItem('system', 'admin/system', 'System');
        $item->addItem('settings', 'admin.system.settings.index', 'Settings', 10);
        $item->addItem('locale', 'admin.system.locale.index', 'Locale', 20);
    }

}
