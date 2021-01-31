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
        $nav = $this->app['navigation'];
        $item = $nav->addItem('catalog', 'admin/catalog', 'Catalog');
        $item->addItem('products', 'admin.catalog.products.index', 'Products');
        
    }

}
