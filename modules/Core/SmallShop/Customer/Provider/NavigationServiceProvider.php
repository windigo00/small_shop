<?php
namespace Modules\Core\SmallShop\Customer\Provider;

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
        $item = $nav->getItem('sales');
        $item->addItem('customers', 'admin.customers.index', 'Customers', 10);
    }

}
