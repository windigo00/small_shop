<?php

namespace Modules\Core\SmallShop\Catalog\Provider;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Modules\Core\SmallShop\Catalog\Model\Product;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modules\Core\SmallShop\Catalog\Http\Controller';

    /**
     *
     * @var string
     */
    protected $admin_namespace = 'Modules\Core\SmallShop\Catalog\Http\Controller\Admin';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Route::pattern('id', '[0-9]+');
        Route::pattern('product:seo_name', '[a-z0-9_]+');
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
//        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $path = realpath(__DIR__.'/../routes/');
//
        Route::middleware(['web', 'auth'])
            ->namespace($this->admin_namespace)
            ->prefix('admin/catalog')
            ->name('admin.catalog.')
            ->group("{$path}/admin.php");
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group("{$path}/default.php");
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
//        Route::prefix('api')
//            ->middleware('api')
//            ->namespace($this->namespace)
//            ->group(base_path('routes/api.php'));
    }
}
