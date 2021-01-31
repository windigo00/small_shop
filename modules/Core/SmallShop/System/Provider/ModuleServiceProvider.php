<?php

namespace Modules\Core\SmallShop\System\Provider;

use Modules\Core\SmallShop\System\View\Components\LanguageSelector;

class ModuleServiceProvider extends \App\Providers\ModuleServiceProvider
{
    protected $module_name = 'system';
    protected $module_directory = __DIR__;

    public function boot(): void
    {
        parent::boot();

        // register system-* components
        $this->loadViewComponentsAs($this->module_name, [
            LanguageSelector::class
        ]);
    }
}
