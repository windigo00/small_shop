<?php
namespace Modules\Core\SmallShop\Sales\Provider;

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
        $item = $nav->addItem('sales', 'admin/sales', 'Sales');
        $item->addItem('orders', 'admin/sales/orders', 'Orders');
        $item->addItem('invoices', 'admin/sales/invoices', 'Invoices');
    }

}
