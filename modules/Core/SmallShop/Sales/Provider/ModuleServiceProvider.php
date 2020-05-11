<?php

namespace Modules\Core\SmallShop\Sales\Provider;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ModuleServiceProvider extends \App\Providers\ModuleServiceProvider
{
    protected $module_name = 'sales';
    protected $module_directory = __DIR__;

}
