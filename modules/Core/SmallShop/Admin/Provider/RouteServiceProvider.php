<?php

namespace Modules\Core\SmallShop\Admin\Provider;

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
    protected $namespace = 'Modules\Core\SmallShop\Admin\Http\Controller';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $path = realpath(__DIR__.'/../routes/');
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->prefix('admin')
            ->name('admin.')
            ->group("{$path}/admin.php");
    }

}
