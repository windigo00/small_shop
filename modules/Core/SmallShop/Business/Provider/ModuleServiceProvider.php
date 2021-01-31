<?php

namespace Modules\Core\SmallShop\Business\Provider;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ModuleServiceProvider extends \App\Providers\ModuleServiceProvider
{
    protected $module_name = 'business';
    protected $module_directory = __DIR__;

}
