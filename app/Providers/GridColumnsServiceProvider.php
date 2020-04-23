<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Grid;

/**
 * Description of GridColumnsServiceProvider
 *
 * @author windigo
 */
class GridColumnsServiceProvider extends ServiceProvider {
//    public function boot()
//    {
//
//        parent::boot();
//    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Grid::class, function ($app) {
            return new Grid(config('riak'));
        });
    }
}
