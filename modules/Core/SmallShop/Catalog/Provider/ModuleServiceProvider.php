<?php

namespace Modules\Core\SmallShop\Catalog\Provider;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ModuleServiceProvider extends \App\Providers\ModuleServiceProvider
{
    protected $module_name = 'catalog';
    protected $module_directory = __DIR__;

}
