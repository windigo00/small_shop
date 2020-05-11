<?php

namespace Modules\Core\SmallShop\Sales\Provider;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modules\Core\SmallShop\Sales\Http\Controller';
    protected $admin_namespace = 'Modules\Core\SmallShop\Sales\Http\Controller\Admin';


    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $path = realpath(__DIR__.'/../routes/');
        Route::middleware(['web', 'auth'])
            ->prefix('admin/sales')
            ->name('admin.sales.')
            ->namespace($this->admin_namespace)
            ->group("{$path}/admin.php");
//        Route::middleware(['web'])
//            ->namespace($this->namespace)
//            ->group("{$path}/default.php");
    }
}
