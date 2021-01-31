<?php
namespace Modules\Core\SmallShop\Business\Provider;

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
        $item = $nav->addItem('business', 'admin/business', 'Business');
        $item->addItem('tasks', 'admin.business.tasks.index', 'Tasks');
        $item->addItem('invoices', 'admin.business.invoices.index', 'Invoices');
        $item->addItem('customers', 'admin.business.contracts.contractors.index', 'Contractors');

    }

}
