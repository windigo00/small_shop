<?php
namespace Modules\Core\SmallShop\Catalog\Provider;

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
            'uri' => 'admin/catalog',
            'title' => 'Catalog',
            'items' => [
                [
                    'uri' => 'admin.catalog.products.index',
                    'title' => 'Products'
                ]
            ]
        ]);
    }

}
