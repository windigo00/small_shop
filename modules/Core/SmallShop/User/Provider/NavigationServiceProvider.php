<?php
namespace Modules\Core\SmallShop\User\Provider;

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
        $item = $nav->getItem('system');
        $item->addItem('users', 'admin.users.index', 'Users');
    }

}
