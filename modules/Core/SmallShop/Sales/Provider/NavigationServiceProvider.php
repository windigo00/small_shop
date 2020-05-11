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

        $this->app['navigation']->addItem([
            'uri' => 'admin/sales',
            'title' => 'Sales',
            'items' => [
                [
                    'uri' => 'admin/sales/orders',
                    'title' => 'Orders'
                ]
            ]
        ]);
    }

}
